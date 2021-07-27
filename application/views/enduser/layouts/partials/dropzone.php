
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/min/dropzone.min.css">
<style type="text/css">
    .dropzone .dz-preview.dz-image-preview {
        background: transparent !important;
    }
    .dz-image img {
        height: 100%;
        width: auto;
    }
    .dropzone {
        min-height: 150px;
        background-color: transparent;
        border: 1px solid transparent;
        border-radius: 4px;
        box-shadow: 0 1px 1px rgba(0,0,0,.05);
        border-color: #1CA8DD;
        padding: 20px 20px;
    }
</style>
<script type="text/javascript">
    Dropzone.autoDiscover = false;
    $(function () {
        /**
         * Only for duplicates (easiest way it seems)
         * @type Array
         */
        var current_queue = [];

        var dz_sort = new Dropzone('#dropzone', {
            url: '/neou_cms/project_image_handler/upload',
            autoProcessQueue: false,
            maxFiles: <?php echo $num_image_fields; ?>,
            acceptedFiles: 'image/*',
            addRemoveLinks: true,
            parallelUploads: 1,
            maxFilesize: <?php echo intval($max_img_file_size); ?>,
            init: function () {
                var submitButton = document.querySelector('#process');
                submitButton.addEventListener("click", function () {
                    if (dz_sort.getQueuedFiles().length < 1) {
                        disable_box();
                        sort(null, true);
                    } else {
                        disable_box();
                        dz_sort.processQueue();
                    }
                });
                $.getJSON('/neou_cms/projects/images_ajax/<?php echo $id; ?>', function (data) {
                    if (typeof data.status !== 'undefined') {
                        neou_cms.display_error_message($('#info'), data.msg);
                    } else {
                        $.each(data, function (key, value) {
                            add_to_dz(value.opts);
                        });
                    }
                });
            }
        });

        var add_to_dz = function (resp) {
            var file = {
                name: resp.name,
                size: resp.size,
                status: Dropzone.ADDED,
                accepted: true,
                order: resp.order
            };
            dz_sort.emit('addedfile', file, true);
            dz_sort.emit('thumbnail', file, resp.thumb);
            dz_sort.emit('complete', file, true);
            dz_sort.files.push(file);
        };

        var sort = function (curr_file_name = null, just_sort = false) {
            var sorting_queue = {};
            $.each(dz_sort.files, function (index, file) {
                if (curr_file_name !== null && file.name == curr_file_name) {
                    return true; // skip to next
                }
                sorting_queue[file.name] = file.order;
            });
            $.ajax({
                url: '/neou_cms/project_image_handler/sort',
                type: 'POST',
                dataType: 'json',
                data: {
                    id: <?php echo $id; ?>,
                    order: JSON.stringify(sorting_queue)
                },
                success: function (data) {
                    if (data.status === 'error') {
                        console.log('DZ: Error occured when sorting');
                        neou_cms.display_error_message($('#info'), data.msg);
                    } else if (just_sort) {
                        neou_cms.display_success_message($('#info'), data.msg);
                    }
                }
            });

            if (dz_sort.getUploadingFiles().length == 0) {
                enable_box();
            }
        };

        var move_last_to_pos = function (order) {
            // move newly added image to proper position
            var selector = $('#dropzone .dz-preview');
            var new_image = selector.last();
            var total = selector.length;
            // each starts at 0, count starts at 1, add 1 to count
            selector.each(function (count, el) {
                if (count + 1 === order) {
                    // if element isn't the same as the new image
                    // if element isn't the last
                    if (el !== new_image && order !== total) {
                        jQuery(new_image).detach().insertBefore(el);
                    }
                    return false; // break
                }
            });
        }

        dz_sort.on('maxfilesexceeded', function (file) {
            bootbox.alert('You can only upload <?php echo $num_image_fields; ?> files!');
            dz_sort.removeFile(file);
        });

        dz_sort.on('addedfile', function (file, start) {
            if ($.inArray(file.name, current_queue) !== -1) {
                errors.html('A file with this name already exists in the queue.');
                dz_sort.removeFile(file);
            } else {
                // order is already added for existing images onload
                if (!start) {
                    // add order as last by default
                    file.order = dz_sort.files.length;
                }
                current_queue.push(file.name);
            }
        });

        dz_sort.on('removedfile', function (file) {
            current_queue.splice($.inArray(file.name, current_queue), 1);
            // ajax call to delete file...
            $.ajax({
                url: '/neou_cms/project_image_handler/delete',
                type: 'POST',
                dataType: 'json',
                data: {
                    id: <?php echo $id; ?>,
                    order: file.order,
                    filename: file.name
                },
                success: function (data) {
                    if (data.status === 'error') {
                        console.log('DZ: Error occured deleting image file ' + file.name);
                        neou_cms.display_error_message($('#info'), data.msg);
                        //add_to_dz(file); // add file back
                        //move_last_to_pos(file.order); // reposition file
                    }
                }
            });
        });

        dz_sort.on('error', function (error) {
            console.log('on error triggered with error:');
            console.log(error);
        });

        dz_sort.on('sending', function (file, xhr, formData) {
            formData.append('id', <?php echo $id; ?>);
            formData.append('order', file.order);
            formData.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>');
        });

        dz_sort.on('complete', function (file, start) {
            if (file.accepted === false) {
                neou_cms.display_error_message($('#info'), 'File not accepted.');
                dz_sort.removeFile(file);
                return false;
            }
            if (!start) {
                var resp = JSON.parse(file.xhr.response);
                if (resp.status === 'error') {
                    // an upload error occured
                    console.log('DZ: Error occured uploading ' + file.name);
                    neou_cms.display_error_message($('#info'), 'Upload ' + file.name + ' failed with error: ' + resp.msg);
                    dz_sort.removeFile(file);
                    // we still want to sort if changed order
                    sort();
                } else {
                    // remove file so we can all the new attributes
                    dz_sort.removeFile(file);
                    // set resp order as local order
                    resp.msg.order = file.order;
                    // add new file with up-to-date attributes
                    add_to_dz(resp.msg);
                    // move
                    move_last_to_pos(file.order);
                    // resort other files
                    sort(resp.msg.name);
                    // continue processing the queue...
                    dz_sort.processQueue();
                }
            }
        });
        
        var enable_box = function () {
            $('.dropzone').sortable('enable');
            neou_cms.remove_loading_button($('#process'));
        };

        var disable_box = function () {
            $('.dropzone').sortable('disable');
            neou_cms.loading_button($('#process'), 'Working...');
        };

        $('.dropzone').sortable({
            items: '.dz-preview',
            cursor: 'move',
            opacity: 0.5,
            containment: '.dropzone',
            distance: 20,
            tolerance: 'pointer',
            stop: function () {
                var queue = dz_sort.files;
                var new_queue = [];
                $('#dropzone .dz-preview .dz-filename [data-dz-name]').each(function (count, el) {
                    var name = el.innerHTML;
                    queue.forEach(function (file) {
                        if (file.name === name) {
                            file.order = count + 1;
                            new_queue.push(file);
                        }
                    });
                });
                dz_sort.files = new_queue;
            }
        });
    });
</script>
<h2 class="m-b-md"><?php echo lang('projects_images_for') . ' ' . $row->project_name; ?></h2>
<div class="bs-callout bs-callout-primary" id="info">
    <strong>Information: </strong>
    <span id="click-here"><a href="javascript:void(0);" id="click-info">Click here</a></span>
    <div id="info-block" style="display:none;">
        <ul>
            <li>Drag files into the box, or click in the box to add files. Once you are done adding your files, you can click the Process button to upload the files. Before and after the queue is completed you can sort files by dragging them into the preferred positions. Changes are only saved when you click the Process button.</li>
            <li>Maximum file size for image uploads: <span class="text-warning"><?php echo $max_img_file_size; ?></span></li>
            <li>Main image dimensions: <?php echo $image_dimensions['main_image_width']; ?> (W) <?php echo $image_dimensions['main_image_height']; ?> (H)</li>
            <li>Thumbnail image dimensions: <?php echo $image_dimensions['thumb_width']; ?> (W) <?php echo $image_dimensions['thumb_height']; ?> (H)</li>
        </ul>
    </div>
</div>
<form class="dropzone" id="dropzone" method="post" enctype="multipart/form-data" class="panel panel-primary"></form>
<button id="process" class="btn btn-primary m-t">Process</button>
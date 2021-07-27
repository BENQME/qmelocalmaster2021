<?php //print_r($page_data) ?>
<section class="page-header">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h2><?php echo $page_data->pageTitle ?></h2>
      </div>
      <!-- end col-12 --> 
    </div>
    <!-- end row --> 
  </div>
  <!-- end container --> 
</section>
<section class="content-section no-space">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <div class="page_content">
		<?php if($page_data->pageContent) echo $page_data->pageContent; ?>
        </div>
      </div>
      <!-- end col-8 -->
      <div class="col-lg-4">
        <aside class="sidebar sticky-top">
        <?php echo sidebar('home_bottom')?>
          
        </aside>
        <!-- end sidebar --> 
      </div>
      <!-- end col-4 --> 
    </div>
    <!-- end row --> 
  </div>
  <!-- end container --> 
</section>
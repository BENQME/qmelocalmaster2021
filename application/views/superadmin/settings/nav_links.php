<style>
.tab-pane22 .card{padding:10px}
</style>
<ul class="nav nav-tabs " role="tablist">
    <?php $current =  $this->uri->segment(2); ?>
    <li class="nav-item">
        <a class="nav-link<?php if(!isset($current)||(isset($current) && $current =='settings')) echo ' active' ?>"  href="<?php echo base_url('settings') ?>" role="tab">Email Template</a>
    </li>
    <li class="nav-item">
        <a class="nav-link<?php if(isset($current) && $current =='smtp') echo ' active' ?>" href="<?php echo base_url('settings/smtp') ?>" role="tab">SMTP Settings </a>
    </li>
     <li class="nav-item">
        <a class="nav-link<?php if(isset($current) && $current =='categories') echo ' active' ?>" href="<?php echo base_url('settings/categories') ?>" role="tab">Categories</a>
    </li>
     <li class="nav-item">
        <a class="nav-link<?php if(isset($current) && $current =='site_resource') echo ' active' ?>" href="<?php echo base_url('settings/site_resource') ?>" role="tab">Resource Onboarding</a>
    </li>
    
</ul>
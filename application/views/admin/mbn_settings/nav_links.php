<style>
.steelton_home_section .nav-tabs.fix_mar .nav-link {
    margin-right: 0;
	padding: 6px;
}
</style>
<ul class="nav nav-tabs fix_mar" role="tablist">
    <?php $current =  $this->uri->segment(2); ?>
    <li class="nav-item">
        <a class="nav-link<?php if(!isset($current)||(isset($current) && $current =='mbncms')) echo ' active' ?>"  href="<?php echo base_url('mbncms') ?>" role="tab">CMS Pages</a>
    </li>
   
    <li class="nav-item">
        <a class="nav-link<?php if((isset($current) && $current =='media')) echo ' active' ?>"  href="<?php echo base_url('mbncms/media') ?>" role="tab">Media</a>
    </li>
    <li class="nav-item">
        <a class="nav-link<?php if((isset($current) && $current =='widgets')) echo ' active' ?>"  href="<?php echo base_url('mbncms/widgets') ?>" role="tab">Widgets</a>
    </li>
    <li class="nav-item">
        <a class="nav-link<?php if((isset($current) && $current =='sponsers')) echo ' active' ?>"  href="<?php echo base_url('mbncms/sponsers') ?>" role="tab">Sponsors</a>
    </li>
    <li class="nav-item">
        <a class="nav-link<?php if((isset($current) && $current =='sponsors_category')) echo ' active' ?>"  href="<?php echo base_url('mbncms/sponsors_category') ?>" role="tab">Sponsors Category</a>
    </li>
    <li class="nav-item">
        <a class="nav-link<?php if((isset($current) && $current =='magazine')) echo ' active' ?>"  href="<?php echo base_url('mbncms/magazine') ?>" role="tab">Digital Magazine</a>
    </li>
    <li class="nav-item">
        <a class="nav-link<?php if((isset($current) && $current =='magazine_cat')) echo ' active' ?>"  href="<?php echo base_url('mbncms/magazine_cat') ?>" role="tab">Magazine Category</a>
    </li>
    <li class="nav-item">
        <a class="nav-link<?php if((isset($current) && $current =='site_sponsors')) echo ' active' ?>"  href="<?php echo base_url('mbncms/site_sponsors') ?>" role="tab">Site Sponsors</a>
    </li>
    <li class="nav-item">
        <a class="nav-link<?php if((isset($current) && $current =='partners')) echo ' active' ?>"  href="<?php echo base_url('mbncms/partners') ?>" role="tab">Partners</a>
    </li>
    <li class="nav-item">
        <a class="nav-link<?php if((isset($current) && $current =='team')) echo ' active' ?>"  href="<?php echo base_url('mbncms/team') ?>" role="tab">Team</a>
    </li>
    <li class="nav-item">
        <a class="nav-link<?php if((isset($current) && $current =='hbcu')) echo ' active' ?>"  href="<?php echo base_url('mbncms/hbcu') ?>" role="tab">HBCU/PBI</a>
    </li>
     <li class="nav-item">
        <a class="nav-link<?php if((isset($current) && $current =='home_category')) echo ' active' ?>"  href="<?php echo base_url('mbncms/home_category') ?>" role="tab">Settings</a>
    </li>
     
    <?php /*?><li class="nav-item">
        <a class="nav-link<?php if(isset($current) && $current =='smtp') echo ' active' ?>" href="<?php echo base_url('mbncms/smtp') ?>" role="tab">SMTP Settings </a>
    </li>
     <li class="nav-item">
        <a class="nav-link<?php if(isset($current) && $current =='categories') echo ' active' ?>" href="<?php echo base_url('mbncms/categories') ?>" role="tab">Categories</a>
    </li><?php */?>
    
</ul>

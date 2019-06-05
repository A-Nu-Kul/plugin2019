<!-- Create a header in the default WordPress 'wrap' container -->
<div class="wrap">
    <h2>Gandhipeace Donation</h2>

    <div style="background:#FFF6D5;border: 1px solid #D1B655;color: #3F2502;margin: 10px 0;padding: 5px 5px 5px 10px;text-shadow: 1px 1px #FFFFFF;">	
        <p>
            The usage instruction is available on the Gandhipeace Donation plugin <a href="http://anukuls.sgedu.site/plugin" target="_blank">documentation page</a>.
        </p>
        
    </div>

    <h2 class="nav-tab-wrapper">
        <ul id="gandhipeace-donation-tabs">
            <li id="gandhipeace-donation-tab_1" class="nav-tab nav-tab-active"><?php _e('General', 'gandhipeace-donation'); ?></li>
            <li id="gandhipeace-donation-tab_2" class="nav-tab"><?php _e('Advanced', 'gandhipeace-donation'); ?></li>
        </ul>
    </h2>

    <form method="post" action="options.php">
        <?php settings_fields($optionDBKey); ?>
        <div id="gandhipeace-donation-tabs-content">
            <div id="gandhipeace-donation-tab-content-1">
                <?php do_settings_sections($pageSlug); ?>
            </div>
        </div>
        <?php submit_button(); ?>
    </form>

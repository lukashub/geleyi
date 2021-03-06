<?php include 'builder/hc_tpl_defaults.php' ?>
<script type="text/javascript" src="<?php echo HYBRIDCONNECT_JS_JQCOLORS ?>/jquery.miniColors.js"></script>
<link type="text/css" rel="stylesheet" href="<?php echo HYBRIDCONNECT_JS_JQCOLORS ?>/jquery.miniColors.css" />
<link type="text/css" rel="stylesheet" href="<?php echo HYBRIDCONNECT_CSS_PATH_TEMPLATES ?>/hc_tpl_fonts.css" />
<link type="text/css" rel="stylesheet" href="<?php echo HYBRIDCONNECT_CSS_PATH_TEMPLATES ?>/south-street/jquery-ui-1.8.20.custom.css" />
<!--<link type="text/css" rel="stylesheet" href="<?php echo HYBRIDCONNECT_CSS_PATH_TEMPLATES ?>/jquery-ui-1.css" />-->
<?php
$protocol = 'http:';
if (!empty($_SERVER['HTTPS'])) {
    $protocol = 'https:';
}
?>
<link href='<?php echo $protocol; ?>//fonts.googleapis.com/css?family=Dosis|Droid+Sans|Crushed|Parisienne|Lora|PT+Sans|PT+Sans+Narrow|Ubuntu|Lobster|Anton|Holtwood+One+SC|Russo+One|Great+Vibes|Droid+Serif|Open+Sans|Oswald|Yanone+Kaffeesatz|Homenaje|Bowlby+One+SC|Seaweed+Script|News+Cycle|Oxygen|Open+Sans'
      rel='stylesheet' type='text/css'>
      <?php
      $hc_ajax_nonce = wp_create_nonce("hyconspecialsecurityforajaxstring");
      ?>
<input type="hidden" id="hc_hidden_services_ajaxnonce" value="<?php echo $hc_ajax_nonce ?>" />
<input type="hidden" id="hc_tpl_page_id_connector" value="<?php echo $my_connector->IntegrationID ?>" />
<input type="hidden" id="hc_default_template" value="<?php echo $style_connector->default_template ?>" />
<input type="hidden" id="hc_tpl_page_id_variation" value="<?php echo $idVariation ?>" />
<?php include_once 'builder/hc_admin_tpl_style1.php'; ?>
<!-- div for lightbox previews -->
<div id="templateCode">
    <div class="lightbox_preview_overlay" id="lightbox_preview_overlay" style="display:none"></div>

    <table style="width: 1500px;" class="tbuilderWrapper">
        <tbody><tr>
                <?php include_once 'builder/hc_admin_tpl_builder_template.php' ?>
                </td>
                <td width="50">
                </td>
                <td valign="top">
                    <?php if ($tpl_type->testing != 1 && $variation->enabled == 1): ?>
                        <div class="ui-draggable" id="draggable" style="width: 600px; height: 600px; position: relative;">
                            <div class="ui-tabs ui-widget ui-widget-content ui-corner-all" id="tabs" style="border:1px solid #000000; background-image:url('<?php echo HYBRIDCONNECT_IAMGES_PATH ?>/dragBackground.png'); background-repeat:repeat-y;">
                                <ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
                                    <li class="ui-state-default ui-corner-top"><a href="#tabs-1">Templates</a></li>
                                    <li class="ui-state-default ui-corner-top"><a href="#tabs-2">Customise</a></li>
                                    <li class="ui-state-default ui-corner-top ui-tabs-selected ui-state-active"><a href="#tabs-3">Enter your Text</a></li>
                                    <li class="ui-state-default ui-corner-top"><a href="#tabs-4">Images</a></li>
                                    <li <?php if ($variation->control == 0): ?>style="display:none;"<?php endif ?> class="ui-state-default-cancel ui-corner-top"><a href="#tabs-5">Lightbox/Slide In Settings</a></li>
                                </ul>
                                <?php include_once 'builder/hc_admin_tpl_templates_tab.php' ?>
                                <?php include_once 'builder/hc_admin_tpl_customize_tab.php' ?>
                                <?php include_once 'builder/hc_admin_tpl_text_tab.php' ?>
                                <?php include_once 'builder/hc_admin_tpl_image_tab.php' ?>
                                <?php include_once 'builder/hc_admin_tpl_lightbox_tab.php' ?>
                            </div>
                            <div id="hc_admin_save_links" style=" margin-top:10px;">
                           <!-- <input type="button" id="hc_sc_cancel_changes" value="Cancel changes" class="hcAdminButton" /> -->
                                <button id="hc_sc_cancel_changes" class="ui-button ui-widget ui-state-default-cancel ui-corner-all ui-button-text-only" role="button" aria-disabled="false"><span class="ui-button-text">Cancel Changes</span></button>
                                <!-- <input type="button" id="hc_sc_save_changes" value="Save changes" class="hcAdminButton" /> -->
                                <button id="hc_sc_save_changes" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false"><span class="ui-button-text">Save Changes</span></button>
                                <button id="hc_sc_save_as_template" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false" style="float:right; background:#FFB30F; border-color:#cc6600;"><span class="ui-button-text">Save as Template</span></button>
                            </div>
                        </div>
                    <?php else: ?>
                        <div style="width: 400px;margin-top: 150px;">
                            <?php if ($variation->enabled == 1): ?>
                                <div>You are in <b>viewing only mode</b> because this design is currently used in a test.</div>
                            <?php else: ?>
                                You are in viewing only mode
                            <?php endif ?>
                            <div id="hc_admin_save_links" style=" margin-top:10px;">
                                <button id="hc_sc_cancel_changes" class="ui-button ui-widget ui-state-default-cancel ui-corner-all ui-button-text-only" role="button" aria-disabled="false" style="float:right;"><span class="ui-button-text">Return</span></button>
                            </div>
                        </div>
                    <?php endif ?>

                </td>
            </tr></tbody></table>
</div>
<script type="text/javascript">
    window.hybridConnectorType=2;
    function try_save(type) {
        var lightboxActivated = jQuery("input#lightboxActivatedCheckbox").attr("checked");
        var excluded_pages = "";
        var included_pages = "";
        var excluded_posts = "";
        var included_posts = "";
        var excluded_cats = "";
        var included_cats = "";
        jQuery(".hc_lb_excluded_pages_checkbox:checked").each(function(){
            excluded_pages = excluded_pages + jQuery(this).val() + "-";
        });
        jQuery(".hc_lb_included_pages_checkbox:checked").each(function(){
            included_pages = included_pages + jQuery(this).val() + "-";
        });
        jQuery(".hc_lb_excluded_posts_checkbox:checked").each(function(){
            excluded_posts = excluded_posts + jQuery(this).val() + "-";
        });
        jQuery(".hc_lb_included_posts_checkbox:checked").each(function(){
            included_posts = included_posts + jQuery(this).val() + "-";
        });
        jQuery(".hc_lb_excluded_cats:checked").each(function(){
            excluded_cats = excluded_cats + jQuery(this).val() + "-";
        });
        jQuery(".hc_lb_included_cats_checkbox:checked").each(function(){
            included_cats = included_cats + jQuery(this).val() + "-";
        });
        var all_pages = (jQuery('#hc_lb_displayed_select').val()=="allpages") ? 1 : 0;
        var all_posts = (jQuery('#hc_lb_displayed_select').val()=="allposts") ? 1 : 0;
        var all_posts_and_pages =  (jQuery('#hc_lb_displayed_select').val()=="allpostsandpages") ? 1 : 0;
        var homepage = (jQuery('#hc_lb_displayed_select').val()=="homepage") ? 1 : 0;
        var singleCategory = (jQuery('#hc_lb_displayed_select').val()=="certaincategories") ? 1 : 0;
        var singlePage = (jQuery('#hc_lb_displayed_select').val()=="singleposts" || jQuery('#hc_lb_displayed_select').val()=="singlepages") ? 1 : 0;
        var time_enable = jQuery('#hc_lb_time_enable').attr('checked');
        var on_time = parseInt(jQuery('#hc_lb_on_time').val());
        var on_click = jQuery('#hc_lb_on_click').val();
        var cookie_lifetime = jQuery("#hc_lb_cookie_life").val();
        var cookie_enable = jQuery("#hc_lb_cookie_enable").attr('checked');
        var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;
        if(time_enable && !numberRegex.test(on_time)) {
            jQuery('#hc_admin_notification_dialog_txt').html("Please enter a number in the 'Seconds after page load' section!");
            jQuery("#hc_admin_notification_dialog").dialog('open');
            return false;
        }
        if(cookie_enable && !numberRegex.test(cookie_lifetime)) {
            jQuery('#hc_admin_notification_dialog_txt').html("Please enter a number in the 'Cookie duration' section!");
            jQuery("#hc_admin_notification_dialog").dialog('open');
            return false;
        }
        var style_image_arrow_type = 1;
        var style_tick = jQuery(".radioSelTickType:checked").val();
        
        /* optin bar options */

        
        var style_config_object = {
            con_bulletsize: jQuery("#bulletPointSizeInput").val(),
            con_bulletx: jQuery("#bulletPointHorizontalInput").val(),
            con_bullety: jQuery("#bulletPointVerticalInput").val(),
            oib_optin_activated:jQuery("#slideInActivated").attr("checked"),
            oib_optin_on_click:jQuery("#optinBarOnClick").attr("checked"),
            oib_optin_time_enable:jQuery("#optinBarTimeEnable").attr("checked"),
            oib_optin_on_time:parseInt(jQuery("#optinBarOnTime").val()),
            oib_optin_scroll_enable:jQuery("#optinBarScrollEnable").attr("checked"),
            oib_optin_scroll_size:jQuery("#optinbarScrollSize").val(),
            oib_optin_slide_in_from: jQuery("#slideInFrom").val(),
            oib_optin_slide_in_distance: jQuery("#optinTopBottomMargin").val(),
            oib_optin_start_pos_attribute: jQuery("#optinFromLeftOrRight").val(),
            oib_optin_start_pos_value: jQuery("#optinLeftRightMargin").val(),
            oib_optin_ani_duration: jQuery("#optinAnimationDuration").val(),
            lb_lightbox_overlay_colour: jQuery("#lightboxOverlayColour").val(),
            lb_lightbox_overlay_opacity: (parseFloat(jQuery("input#overlayOpacity").val()))/100,
            lb_lightbox_fade_duration: parseInt(jQuery("input#lightboxFadeDuration").val()),
            lb_activated: lightboxActivated,
            lb_homepage: homepage,
            lb_all_pages: all_pages,
            lb_excluded_pages: excluded_pages,
            lb_excluded_posts: excluded_posts,
            lb_included_pages: included_pages,
            lb_included_posts: included_posts,
            lb_excluded_cats: excluded_cats,
            lb_included_cats: included_cats,
            lb_single_category: singleCategory,
            lb_all_posts_and_pages: all_posts_and_pages,
            lb_single_page: singlePage,
            lb_time_enable: time_enable,
            lb_on_time: on_time,
            lb_all_posts: all_posts,
            lb_on_click: on_click,
            lb_cookie_enable: cookie_enable,
            lb_cookie_life: cookie_lifetime,
            lb_scroll_enable: jQuery("#hc_lb_scroll_enable").attr('checked'),
            lb_scroll_size: jQuery("#scroll_size").val(),
            lb_fadein_enable: jQuery("#hc_lb_fadein_enable").attr('checked'),
            txt_optin_headline: jQuery("#optinBoxHeadline").val(),
            txt_optin_description: tinyMCE.activeEditor.getContent(),
            txt_email_call: jQuery("#emailCallToActionText").val(),
            txt_fb_call: jQuery("#facebookCallToActionText").val(),
            txt_oneclick_call: jQuery("#oneClickCallToActionText").val(),
            txt_email_btn: jQuery("#emailButtonText").val(),
            txt_fb_btn: jQuery("#facebookButtonText").val(),
            txt_oneclick_btn: jQuery("#oneClickButtonText").val(),
            btn_bg_color: jQuery("#buttonBackgroundColor").val(),
            btn_font_color: jQuery("#buttonFontColor").val(),
            btn_txt_shadow_color: jQuery("#buttonTextShadowColor").val(),
            btn_border_color: jQuery("#buttonBorderColor").val(),
            btn_box_shadow: jQuery("#buttonBoxShadow").val(),
            btn_font_family: jQuery("#buttonTextFont").val(),
            btn_type: jQuery("#buttonColourType").val(),
            btn_email_new_line: jQuery("#emailInputNewLine").attr('checked'),
            btn_submit_new_line: jQuery("#submitButtonNewLine").attr('checked'),
            btn_bg_light: shadeColor(jQuery("#buttonBackgroundColor").val(), -50),
            btn_font_size: jQuery("#buttonFontSize").val(),
            btn_lr_padding: jQuery("#buttonLRPadding").val(),
            btn_tb_padding: jQuery("#buttonTBPadding").val(),
            con_opt_in_box_width: jQuery("#connectorWidth").val(),
            con_opt_in_box_height: jQuery("#connectorHeight").val(),
            con_call_action_height: jQuery("#callToActionHeight").val(),
            con_tpl_bg_color: jQuery("#connectorBGColor").val(),
            con_opt_in_bg_color: jQuery("#OptinBGColor").val(),
            con_border_color: jQuery("#borderColor").val(),
            con_border_width: jQuery("#borderWidth").val(),
            con_border_radius: jQuery("#roundedCornerWidth").val(),
            con_set_heights: jQuery("#individualHeightCheckbox").attr('checked'),
            con_eoh: jQuery("#emailBoxHeight").val(),
            con_ech: jQuery("#emailCallToActionHeight").val(),
            con_foh: jQuery("#facebookBoxHeight").val(),
            con_fch: jQuery("#facebookCallToActionHeight").val(),
            con_ooh: jQuery("#oneClickBoxHeight").val(),
            con_och: jQuery("#oneClickCallToActionHeight").val(),
            em_input_border_color: jQuery("#inputFieldBorderColor").val(),
            em_input_bg_color: jQuery("#inputFieldBackgroundColor").val(),
            con_template_gradient: jQuery("#gradientBackgroundCheckbox").attr('checked'),
            con_template_bgcolor_1: jQuery("#templateBGColor1").val(),
            con_template_bgcolor_2: jQuery("#templateBGColor2").val(),
            con_template_picturebg: jQuery("#pictureBackgroundCheckbox").attr('checked'),
            con_template_picturebgurl: jQuery("#imageBackgroundUploadFilePath").val(),
            con_template_transparentbg: jQuery("#transparentBackgroundCheckbox").attr('checked'),
            con_template_transparentoptinbg: jQuery("#transparentOptinBackgroundCheckbox").attr('checked'),
            em_input_font_color: jQuery("#inputTextColor").val(),
            em_input_font_family: jQuery("#inputTextFont").val(),
            image_show_side_image: jQuery("#sidePictureShow").attr('checked'),
            image_url: jQuery("#imageUploadFilePath").val(),
            image_vertical_position: jQuery("#imageVerticalPosition").val(),
            image_left_margin: jQuery("#imageLeftMargin").val(),
            image_right_margin: jQuery("#imageRightMargin").val(),
            image_show_arrow_graphics: jQuery("#arrowGraphicsShow").attr('checked'),
            image_arrow_style: hc_selected_arrow_src,
            opt_name_length: jQuery("#nameFieldLength").val(),
            opt_email_length: jQuery("#emailFieldLength").val(),
            opt_email_centered: jQuery("#emailCentre").attr('checked'),
            opt_fb_centered: jQuery("#facebookCentre").attr('checked'),
            opt_oneclick_centered: jQuery("#oneClickCentre").attr('checked'),
            st_headline_font_color: jQuery("#headlineTextColor").val(),
            st_headline_font_size: jQuery("#headlineFontSize").val(),
            st_headline_font_family: jQuery("#headlineFont").val(),
            st_headline_bold: jQuery("#headlineBold").attr('checked'),
            st_body_font_color: jQuery("#bodyTextColor").val(),
            st_body_font_size: jQuery("#mainFontSize").val(),
            st_body_font_family: jQuery("#bodyFont").val(),
            st_call_action_font_color: jQuery("#callToActionTextColor").val(),
            st_call_action_font_family: jQuery("#callToActionFont").val(),
            st_call_action_font_size: jQuery("#callToActionFontSize").val(),
            st_tick_style: style_tick,
            hc_default_template: jQuery("#hc_default_template").val(),
            st_headline_center: jQuery("#headlineCenter").attr('checked'),
            st_body_center: jQuery("#bodyCenter").attr('checked'),
            st_body_vertical_position: jQuery("#bodyTextVerticalPosition").val(),
            con_dropShadow: jQuery("#dropShadowCheckbox").attr('checked'),
            con_hShadow: jQuery("#hShadow").val(),
            con_vShadow: jQuery("#vShadow").val(),
            con_blurShadow: jQuery("#blurShadow").val(),
            con_shadowColor: jQuery("#shadowColor").val(),
            btn_facebookButtonSize: jQuery("#facebookSize").val(),
            txt_headlineShadow: jQuery("#headlineShadowCheckbox").attr('checked'),
            txt_textShadow: jQuery("#textShadowCheckbox").attr('checked'),
            txt_ctaShadow: jQuery("#ctaShadowCheckbox").attr('checked'),
            txt_hShadow: jQuery("#textHShadow").val(),
            txt_vShadow: jQuery("#textVShadow").val(),
            txt_blurShadow: jQuery("#textBlurShadow").val(),
            txt_shadowColor: jQuery("#textShadowColor").val(),
            txt_headlineLeftMargin: jQuery("#headlineLeftMargin").val(),
            txt_headlineRightMargin: jQuery("#headlineRightMargin").val(),
            txt_textLeftMargin: jQuery("#textLeftMargin").val(),
            txt_textRightMargin: jQuery("#textRightMargin").val(),
            txt_leftMargin: jQuery("#bulletLeftMargin").val(),
            con_borderStyle: jQuery("select#borderStyle").val(),
            em_nameFieldLabel: jQuery("#nameLabelField").val(),
            em_emailFieldLabel: jQuery("#emailLabelField").val(),
            con_showPrivacyPolicy: jQuery("#showPrivacyPolicy").attr('checked'),
            con_boldPrivacyPolicy: jQuery("#boldPrivacyPolicy").attr('checked'),
            con_centerPrivacyPolicy: jQuery("#centerPrivacyPolicy").attr('checked'),
            con_privacyPolicyFont: jQuery("#privacyPolicyFont").val(),
            con_privacyPolicyColour: jQuery("#privacyPolicyColor").val(),
            con_privacyPolicySize: jQuery("#privacyPolicySize").val(),
            txt_privacyText: jQuery("#privacyPolicyText").val(),
            em_fieldFontSize: jQuery("#fieldFontSize").val(),
            em_fieldHeight: jQuery("#fieldHeight").val(),
            em_fieldPaddingTopBottom: jQuery("#fieldPaddingTopBottom").val(),
            em_fieldPaddingLeftRight: jQuery("#fieldPaddingLeftRight").val(),
            em_fieldBorderWidth: jQuery("#fieldBorderWidth").val(),
            em_fieldBorderStyle: jQuery("#fieldBorderStyle").val(),
            em_fieldBorderRadius: jQuery("#fieldBorderRadius").val(),
            con_emailPrivacyPolicyMargin: jQuery("#emailPrivacyPolicyMargin").val(),
            con_facebookPrivacyPolicyMargin: jQuery("#facebookPrivacyPolicyMargin").val(),
            con_oneClickPrivacyPolicyMargin: jQuery("#oneClickPrivacyPolicyMargin").val(),
            con_externalTopMargin: jQuery("#externalTopMargin").val(),
            con_externalBottomMargin: jQuery("#externalBottomMargin").val(),
            image_setImageSize: jQuery("#sideImageSize").val()
        }
        
        var hc_ajax_nonce = jQuery('#hc_hidden_fb_ajaxnonce').val();
        var id_connector = jQuery("#hc_tpl_page_id_connector").val();
        var id_variation = jQuery("#hc_tpl_page_id_variation").val();
        var data = {
            action: 'hc_update_shortcode_template_settings',
            id_connector: id_connector,
            style_config_object: style_config_object,
            type: 2,
            idVariation: id_variation,
            security: hc_ajax_nonce
        };
        jQuery('#hc_admin_ajax_loading').show();
        jQuery.post(ajaxurl, data, function(response) {

            if(type=="template") {
                jQuery('#hc_admin_ajax_loading').hide();
                 // ask for template name
                   jQuery("#getTemplateName").dialog({ height:100, close: function(event, ui) { jQuery(this).dialog('destroy'); } });
                   // destroy any instance of getTemplateName
            } else {


                jQuery('#hc_admin_ajax_loading').hide();
                admin_cancel_template_changes();
                //        jQuery('#hc_admin_notification_dialog_txt').html('Settings saved successfully!');
                //        jQuery("#hc_admin_notification_dialog").dialog('open');
            }
        });
    }
</script>
<?php include_once('builder/hc_admin_tpl_js.php') ?>
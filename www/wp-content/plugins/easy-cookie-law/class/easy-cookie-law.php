<?php 

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class EasyCookieLaw {

    const ECL_COOKIE_NAME = "easy-cookie-law";
    const ECL_OPTIONS_DB = "ecl_options";
    const ECL_SETTINGS = [
        "ecl_text" => [
            "default"   => "Cookies help us deliver our services. By using our services, you agree to our use of cookies.",
            "sanitize"  => "sanitize_text_field",
            "escape"    => "esc_textarea"
        ],
        "ecl_link" => [
            "default"   => "http://www.aboutcookies.org/",
            "sanitize"  => "esc_url",
            "escape"    => "esc_url"
        ],
        "ecl_link_text" => [
            "default"   => "More Info",
            "sanitize"  => "sanitize_text_field",
            "escape"    => "esc_textarea"
        ],
        "ecl_link_target" => [
            "default"   => "_blank",
            "sanitize"  => "esc_attr",
            "escape"    => "esc_attr"
        ],
        "ecl_vertical_bar" => [
            "default"   => 1,
            "sanitize"  => "ecl_to_int",
            "escape"    => "ecl_to_int"
        ],
        "ecl_decline" => [
            "default"   => "Decline",
            "sanitize"  => "sanitize_text_field",
            "escape"    => "esc_textarea"
        ],
        "ecl_close" => [
            "default"   => "Accept",
            "sanitize"  => "sanitize_text_field",
            "escape"    => "esc_textarea"
        ],
        "ecl_position" => [
            "default"   => "bottom",
            "sanitize"  => "esc_attr",
            "escape"    => "esc_attr"
        ],
        "ecl_custom" => [
            "default"   => 0,
            "sanitize"  => "ecl_to_int",
            "escape"    => "ecl_to_int"
        ],
        "ecl_scroll" => [
            "default"   => 0,
            "sanitize"  => "ecl_to_int",
            "escape"    => "ecl_to_int"
        ],
        "ecl_own_style" => [
            "default"   => "",
            "sanitize"  => "esc_textarea",
            "escape"    => "esc_textarea"
        ],
        "ecl_noticecolor" => [
            "default"   => "#ffffff",
            "sanitize"  => "esc_attr",
            "escape"    => "esc_attr"
        ],
        "ecl_textcolor" => [
            "default"   => "#000000",
            "sanitize"  => "esc_attr",
            "escape"    => "esc_attr"
        ],
        "ecl_linkscolor" => [
            "default"   => "#b30000",
            "sanitize"  => "esc_attr",
            "escape"    => "esc_attr"
        ],
        "ecl_gtm_header" => [
            "default"   => "",
            "sanitize"  => 'ecl_sanitize_js',
            "escape"    => 'ecl_escape_js'
        ],
        "ecl_gtm_body" => [
            "default"   => "",
            "sanitize"  => 'ecl_sanitize_js',
            "escape"    => 'ecl_sanitize_js'
        ],
        "ecl_custom_func" => [
            "default"   => 0,
            "sanitize"  => "ecl_to_int",
            "escape"    => "ecl_to_int"
        ],
        "ecl_hide_admin" => [
            "default"   => 1,
            "sanitize"  => "ecl_to_int",
            "escape"    => "ecl_to_int"
        ],
        "ecl_hide_editor" => [
            "default"   => 1,
            "sanitize"  => "ecl_to_int",
            "escape"    => "ecl_to_int"
        ],
        "ecl_hide_author" => [
            "default"   => 1,
            "sanitize"  => "ecl_to_int",
            "escape"    => "ecl_to_int"
        ],
    ];
    const ECL_GTM_HP = "&lt;script&gt;(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&amp;l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-XXXXX');&lt;/script&gt;";
    const ECL_GTM_BP = "&lt;noscript&gt;&lt;iframe src='https://www.googletagmanager.com/ns.html?id=GTM-XXXXX' height='0' width='0' style='display:none;visibility:hidden'&gt;&lt;/iframe&gt;&lt;/noscript&gt;";

    private $options;
    
    /**
     * Load the options variable
     */
    function __construct()
    {
        self::getOptions();
    }

    /**
     * Returns an array extracting the values from the indicated keys
     * from the subarrays
     *
     * @var array $array Array to be used 
     * @var string $field_name Name of the field to be extracted
     * @return array 
     */
    private function extractFromArray($array, $field_name)
    {
        $options = [];
        foreach($array as $key => $value)
        {
            $options[$key] = $value[$field_name];
        }
        return $options;
    }

    /**
     * Get the default options and values
     *
     * @return array 
     */
    private function defaultOptions()
    {
        return self::extractFromArray(self::ECL_SETTINGS, 'default');
    }

    /**
     * Get the default options and and sanitize functions names
     *
     * @return array 
     */
    private function formSanitizeFields()
    {
        return self::extractFromArray(self::ECL_SETTINGS, 'sanitize');
    }

    /**
     * Get the default options and and escape functions names
     *
     * @return array 
     */
    private function formEscapeFields()
    {
        return self::extractFromArray(self::ECL_SETTINGS, 'escape');
    }

    /**
     * Get options from DB
     * If a option is not saved, use the default values
     */
    private function getOptions()
    {
        $default_options = $this->defaultOptions();
        $ecl_options = get_option(self::ECL_OPTIONS_DB, $default_options);

        // In case any options is missing
        foreach($default_options as $key => $value)
        {
            if(!isset($ecl_options[$key]))
            {
                $ecl_options[$key] = $value; 
            }
        }

        // Escape the options
        $escape_fields = $this->formEscapeFields();
        foreach($escape_fields as $key => $value)
        {
            $name = str_replace('ecl_', '', $key);
            $this->options[$name] = $value($ecl_options[$key]);
        }
    }

    /**
     * Print the JS and CSS needed for the notice
     */
    public function printNotice()
    {        
        ?>
        <script type="text/javascript">
            var ecw = document.cookie.replace(/(?:(?:^|.*;\s*)<?php echo self::ECL_COOKIE_NAME; ?>\s*\=\s*([^;]*).*$)|^.*$/, "$1");
            function ecl_set_cookie(typ) {
                if(!typ) type = 'visited';
                var d = new Date();
                d.setTime(d.getTime() + (30*24*60*60*1000));
                var expires = "expires="+ d.toUTCString();
                document.cookie = "<?php echo self::ECL_COOKIE_NAME; ?>" + "=" + typ + ";" + expires + ";path=/";
            }
            function ecl_is_cookie_accepted(){
                if(ecw == 'visited') return true;
            }
            function ecl_is_cookie_declined(){
                if(ecw == 'declined') return true;
            }
            if(ecl_is_cookie_accepted()) {
                var ecl_scripts = document.createElement('script');
                ecl_scripts.innerHTML = <?php echo $this->printGtmHeader(); ?>;
                document.head.appendChild(ecl_scripts);
            }
        </script>
        <?php
    }

    /**
     * Returns CSS and JS of the notice
     */
    public function outPutNotice(){
        
        $ecl_style_otuput = "";
        if( $this->options['custom'] == 0 ) {
            $position = $this->options['position'] == "top" ? "top: 0" : "bottom: 0";
            $ecl_style_otuput = "<style type='text/css'>#ecl-notice{position: fixed; z-index: 1000000; $position; left: 0; width: 100%; font-size: 14px; padding: 0.5em; background-color: ".$this->options['noticecolor']."; color: ".$this->options['textcolor'].";}#ecl-notice a{color:".$this->options['linkscolor'].";}". ecl_css($this->options['own_style']) ."</style>";
        }

        $bar = " | ";
        if( !$this->options['vertical_bar'] ){
            $bar = " ";
        }

        $ecl_notice_output = $ecl_style_otuput . "<div id='ecl-notice'>" . $this->options['text'] ." <a href='". $this->options['link'] ."' target='". $this->options['link_target'] ."' class='ecl_link_more'>". $this->options['link_text'] ."</a>" . $bar ."<a href onclick='ecl_close_and_send();' id='ecl_link_close'>". $this->options['close'] ."</a>" . $bar ."<a href onclick='ecl_decline()';>". $this->options['decline'] ."</a></div>";
        
        return $ecl_notice_output;
    }

    /**
     * Print the notice on the footer
     */
    public function printFooterNotice()
    {
        if(self::hideForUser()){
            return;
        }

        $ecl_notice_output = $this->outPutNotice();
        ?>
        <div id='ecl-notice'></div>
        <script type="text/javascript">
            var ecln = document.getElementById('ecl-notice');
            function ecl_close_and_send(){
                ecl_close_notice();
                ecl_set_cookie('visited');
            }
            function ecl_close_notice(){
                if(ecln) ecln.style.display = "none";
            }
            function ecl_decline(){
                ecl_set_cookie('declined');
            }
            if(ecl_is_cookie_accepted() || ecl_is_cookie_declined() ) {
                ecl_close_notice();
            }else{
                if(ecln) ecln.innerHTML = "<?php echo $ecl_notice_output; ?>";
                <?php if($this->options['scroll']) : ?>
                var ecl_scrolled = false;
                window.addEventListener('scroll', function(e) {
                    if(window.scrollY > 249 && !ecl_scrolled){ 
                        ecl_scrolled = true;
                        ecl_close_and_send(); 
                        printHeader();
                    }
                })
                <?php endif; ?>
            }
        </script>
        <?php 
    }

    /**
     * Print the GTM header script
     */
    public function printGtmHeader()
    {
        if(!empty($this->options['gtm_header']) )
        {
            echo $this->options['gtm_header'];
        }
    }

    /**
     * Collects the POST options and saves it to DB
     * Echoes a success message
     */
    public function saveOptions()
    {

        // Save options if form was sended
        if( isset($_POST['ecl_save_data']) )
        {
            $ecl_options = self::getOptions();
            $fields = self::formSanitizeFields();
            foreach($fields as $key => $value)
            {
                if(isset($_POST[$key]))
                {
                    $ecl_options[$key] = $value($_POST[$key]);
                }
                else
                {
                    $ecl_options[$key] = false; 
                }
            }

            // Remove script tags from gtm_header
            $ecl_options['ecl_gtm_header'] = str_replace("<script>", "", $ecl_options['ecl_gtm_header']);
            $ecl_options['ecl_gtm_header'] = str_replace("<script type=\"text/javascript\">", "", $ecl_options['ecl_gtm_header']);
            $ecl_options['ecl_gtm_header'] = str_replace("</script>", "", $ecl_options['ecl_gtm_header']);

            update_option("ecl_options", $ecl_options);
            echo "<div class='wrap' id='ecl_saved'>" . __('Saved!', 'easy-cookie-law') . "</div>";
        }
    }

    /**
     * Prints the options form
     */
    public function printForm()
    {
        // Make sure the last saved settings are loaded
        // since this functions is usually loaded after updating settings
        self::getOptions();

        /**
         * Form
         */
        ?>
        <div class="wrap ecl_options">

        <h1><?php echo __('Easy Cookie Law Menu Options', 'easy-cookie-law'); ?></h1>

            <form method="post">

                <div class="ecl_column">

                    <!-- Text -->
                    <div class="postbox">
                        <h2><?php echo __('Content', 'easy-cookie-law'); ?></h2>
                        <div class="inside">
                            <div class="form-box">
                                <label for="ecl_text"><?php echo __('Message', 'easy-cookie-law'); ?></label>
                                <textarea rows="5" name="ecl_text" id="ecl_text"><?php echo $this->options["text"]; ?></textarea>
                                <em><?php echo __("People will see this notice only if the use of cookies has not been accepted yet", "easy-cookie-law"); ?></em><br>
                            </div>
                            <div class="form-box">
                                <label for="ecl_link"><?php echo __('More Info URL', 'easy-cookie-law'); ?></label>
                                <input type="url" name="ecl_link" id="ecl_link" value="<?php echo $this->options["link"]; ?>" />
                            </div>
                            <div class="form-box">
                                <label for="ecl_link_text"><?php echo __('More Info text (text showed in the link)', 'easy-cookie-law'); ?></label>
                                <input type="text" name="ecl_link_text" id="ecl_link_text" value="<?php echo $this->options["link_text"]; ?>" />
                            </div>
                            <div class="form-box">
                                <label for="ecl_link_target"><?php echo __('Target of the link', 'easy-cookie-law'); ?></label>
                                <select name="ecl_link_target">
                                    <option value="_blank" <?php if($this->options["link_target"] == "_blank") : ?> selected <?php endif; ?>><?php echo __("New tab or windows", 'easy-cookie-law'); ?></option>
                                    <option value="_self" <?php if($this->options["link_target"] == "_self") : ?> selected <?php endif; ?>><?php echo __("Same window", 'easy-cookie-law'); ?></option>
                                </select>
                            </div>
                            <div class="form-box">
                                <label for="ecl_close"><?php echo __('Text for the link to accept the use of cookies', 'easy-cookie-law'); ?></label>
                                <input type="text" name="ecl_close" id="ecl_close" value="<?php echo $this->options["close"]; ?>" />
                            </div>
                            <div class="form-box">
                                <label for="ecl_decline"><?php echo __('Text for the link to decline the use of cookies', 'easy-cookie-law'); ?></label>
                                <input type="text" name="ecl_decline" id="ecl_decline" value="<?php echo $this->options["decline"]; ?>" />
                            </div>
                            <br>
                            <div class="form-box-check">
                                <input type="checkbox" name="ecl_scroll" id="ecl_scroll" value='1' <?php if($this->options["scroll"] == 1){ echo "checked";} ?> />
                                <?php echo __('Accept the use of cookies if the user scrolls (more than 249px)', 'easy-cookie-law'); ?>
                            </div>
                        </div>
                    </div>

                    <!-- Styles -->
                    <div class="postbox">
                        <h2><?php echo __('Styles', 'easy-cookie-law'); ?></h2>
                        <div class="inside">
                            <div class="form-box-check">
                                <label for="ecl_custom"><?php echo __('Let me use my own CSS', 'easy-cookie-law'); ?></label>
                                <input type="checkbox" name="ecl_custom" id="ecl_custom" value='1' <?php if($this->options['custom'] == 1){ echo "checked";} ?> />
                                <?php echo __('The plugin will not print any styles. Check this if you want to use your custom CSS written in any other stylesheet or inline.', 'easy-cookie-law'); ?>
                            </div>
                            <div id="ecl_css_custom_styles">
                                <div class="form-box">
                                    <label for="ecl_position"><?php echo __('Position of the notice', 'easy-cookie-law'); ?></label>
                                    <?php $top = $this->options['position'] == "top" ? 1 : 2 ; ?>
                                    <input type="radio" name="ecl_position" value="top" <?php if($top == "1"): ?>checked<?php endif; ?>><?php echo __('Top', 'easy-cookie-law'); ?></input>
                                    &nbsp; <input type="radio" name="ecl_position" value="bottom" <?php if($top == "2"): ?>checked<?php endif; ?>><?php echo __('Bottom', 'easy-cookie-law'); ?></input>
                                </div>
                                <div class="form-box">
                                    <label for="ecl_noticecolor">
                                        <input type="color" name="ecl_noticecolor" id="ecl_noticecolor" value="<?php echo $this->options["noticecolor"]; ?>" />
                                        <?php echo __('Background color of the notice', 'easy-cookie-law'); ?>
                                    </label>
                                </div>
                                <div class="form-box">
                                    <label for="ecl_textcolor">
                                        <input type="color" name="ecl_textcolor" id="ecl_textcolor" value="<?php echo $this->options["textcolor"]; ?>" />
                                        <?php echo __('Text color of the notice', 'easy-cookie-law'); ?>
                                    </label>
                                </div>
                                <div class="form-box">
                                    <label for="ecl_linkscolor">
                                    <input type="color" name="ecl_linkscolor" id="ecl_linkscolor" value="<?php echo $this->options["linkscolor"]; ?>" />
                                        <?php echo __('Links color of the notice', 'easy-cookie-law'); ?>
                                    </label>
                                </div>
                                <div class="form-box-check">
                                    <input type="checkbox" name="ecl_vertical_bar" id="ecl_vertical_bar" value='1' <?php if($this->options['vertical_bar'] == 1){ echo "checked";} ?> />
                                    <?php echo __('Show the vertical bar separator "|" between the information and close links', 'easy-cookie-law'); ?>
                                </div>
                                <div class="form-box">
                                    <label for="ecl_own_style"><?php echo __('Put your custom CCS here. It will be inlined', 'easy-cookie-law'); ?></label>
                                    <textarea rows="5" name="ecl_own_style" id="ecl_own_style"><?php echo $this->options["own_style"]; ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="ecl_column">

                    <!-- Roles -->
                    <div class="postbox">
                        <h2><?php echo __('Roles', 'easy-cookie-law'); ?></h2>
                        <div class="inside">
                            <div class="form-box-check">
                                <label for="ecl_hide_admin">
                                    <input type="checkbox" name="ecl_hide_admin" id="ecl_hide_admin" value='1' <?php if($this->options['hide_admin'] == 1){ echo "checked";} ?> />
                                    <?php echo __('Remove notice and tracking code for admins', 'easy-cookie-law'); ?>
                                </label>
                            </div>
                            <div class="form-box-check">
                                <label for="ecl_hide_editor">
                                    <input type="checkbox" name="ecl_hide_editor" id="ecl_hide_editor" value='1' <?php if($this->options['hide_editor'] == 1){ echo "checked";} ?> />
                                    <?php echo __('Remove notice and tracking code for editors', 'easy-cookie-law'); ?>
                                </label>
                            </div>
                            <div class="form-box-check">
                                <label for="ecl_hide_author">
                                    <input type="checkbox" name="ecl_hide_author" id="ecl_hide_author" value='1' <?php if($this->options['hide_author'] == 1){ echo "checked";} ?> />
                                    <?php echo __('Remove notice and tracking code for registered users', 'easy-cookie-law'); ?>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Google Tag Manger -->
                    <div class="postbox anders">
                        <h2><?php echo __('Optional: Google Tag Manager', 'easy-cookie-law'); ?></h2>
                        <div class="inside">
                            <p>
                                <?php echo __("If you use Google Tag Manager, you can put the code here below and this plugin will take care of it, loading it only after the user accepts the use of cookies.", 'easy-cookie-law'); ?>
                                <br>
                            </p>

                            <div class="form-box">
                                <label for="ecl_gtm_header"><?php echo __('Code after the opening of the &lt;head&gt; tag:', 'easy-cookie-law'); ?></label>
                                <textarea rows="5" name="ecl_gtm_header" id="ecl_gtm_header" placeholder="<?php echo self::ECL_GTM_HP; ?>"><?php echo $this->options["gtm_header"]; ?></textarea>
                                <em><?php echo __("Introduce the code withouth &lt;script&gt;&lt;/script&gt; tags. The plugin will block the execution of the code until cookies are accepted", "easy-cookie-law"); ?></em><br>
                            </div>
                            <div class="form-box">
                                <label for="ecl_gtm_body"><?php echo __('Code noscript after the opening of the &lt;body&gt; tag:', 'easy-cookie-law'); ?></label>
                                <textarea rows="5" name="ecl_gtm_body" id="ecl_gtm_body" placeholder="<?php echo self::ECL_GTM_BP; ?>"><?php echo $this->options["gtm_body"]; ?></textarea>
                                <em>
                                    <?php echo __("This requires a tiny manual action from your side: you need to put the following PHP lines on your theme:", "easy-cookie-law"); ?><br>
                                    <pre><code>&lt;?php if(function_exists('ecl_print_body')) ecl_print_body(); ?&gt;</code></pre>
                                    <?php echo __("Normally, you must put this only in your 'header.php' file, directly after the opening of the &lt;body&gt;; tag, but this may vary depending on your theme.", "easy-cookie-law"); ?><br>
                                    <br>
                                    <?php echo sprintf( __('If you need help, contact the author of the plugin at <a href="%s" target="_blank">asanchez.dev</a> or ask in the <a href="%s" target="_blank">support forum</a>.', 'easy-cookie-law'),
                                    'https://asanchez.dev', 'https://wordpress.org/support/plugin/easy-cookie-law/'); ?>
                                </em>
                                <br>
                            </div>
                            <div class="form-box-check">
                                <label for="ecl_custom_func"><?php echo __('Let me manually print the GMT code for the header where I want', 'easy-cookie-law'); ?></label>
                                <input type="checkbox" name="ecl_custom_func" id="ecl_custom_func" value='1' <?php if($this->options['custom_func'] == 1){ echo "checked";} ?> />
                                <em>
                                    <?php echo __('Check this if you want to modify your theme to print the GMT header code where you want. For this, you have to put this function where you want to print the code:', 'easy-cookie-law'); ?><br>
                                    <pre><code>&lt;?php if(function_exists('ecl_print_all')) ecl_print_all(); ?&gt;</code></pre>
                                    <?php echo __('This function will print he GMT code for the header in the position you want, instead of using the wp_head action hook. Normally you should use this if you want to print the code on the top of your &lt;head&gt;; tag, as Google recommends.', 'easy-cookie-law'); ?>
                                </em>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Submit button -->
                <div class="inside">
                    <div class="form-box">
                        <input type="submit" id="ecl_save_data" name="ecl_save_data" class="button button-primary" value="<?php echo __('Update', 'easy-cookie-law'); ?>" />
                    </div>
                </div>

            </form>
        </div>
        <?php
    }

    /**
     * Returns false if the visitor should be able to see the notice based on its role
     * 
     * @return boolean
     */
    private function hideForUser()
    {
        $current_user = wp_get_current_user();
        
        if($this->options['hide_admin'] == 1 && in_array('administrator', $current_user->roles))
        {
            return true;
        }

        if($this->options['hide_editor'] == 1 && in_array('editor', $current_user->roles))
        {
            return true;
        }

        if($this->options['hide_author'] == 1 && in_array('author', $current_user->roles))
        {
            return true;
        } 

        return false;
    }

    /**
     * Get the GTM body script
     * 
     * @return string 
     */
    public function returnBodyScripts()
    {
        if( !self::hideForUser() && self::is_cookie_accepted() ){
            return $this->options['gtm_body'];
        }
    }

    /**
     * Check if cookies are accepted
     * This function use same format for the name as in JS for usability reasons
     * 
     * @return boolean 
     */
    public function is_cookie_accepted()
    {
        if(isset($_COOKIE[self::ECL_COOKIE_NAME])){
            $ecw = $_COOKIE[self::ECL_COOKIE_NAME];
            if($ecw == 'visited'){
                return true;
            } 
        };
    }

     /**
     * Check if the wp_head action hook should be used
     * 
     * @return boolean 
     */
    public function useWPHeadHook()
    {
        if(!$this->options['custom_func'] || $this->options['custom_func'] == 0 )
        {
            return true;
        }
        
        return false;
    }
}
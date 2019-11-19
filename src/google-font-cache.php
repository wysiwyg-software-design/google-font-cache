<?php
	
	/**
	 * Plugin name: Google Font Cache
	 * Plugin URI: https://github.com/wysiwyg-software-design/google-font-cache
	 * Description: A WordPress Plugin to cache Google Fonts to your server to avoid GDPR conflicts
	 * Version: 1.0.0
	 * Author: Cem Derin (wysiwyg software design GmbH)
	 * Author URI: https://wysiwyg.de
	 */

    class GoogleFontCacher {
        /**
         * GoogleFontCacher constructor.
         */
        public function __construct() {
            $this->addFilters();
        }

        /**
         * Adds all plugin relevant filters
         */
        public function addFilters() {
            add_filter('style_loader_tag', function($tag, $handle, $href) {
                return $this->handleStyleTag($tag, $handle, $href);
            }, 10, 3);
        }

        /**
         * Handles a single style tag
         *
         * @param $tag
         * @param $handle
         * @param $href
         * @return mixed
         */
        public function handleStyleTag($tag, $handle, $href) {
            // check for google api
            if(substr_count($href, 'fonts.googleapis.com') > 0) {
                try {
                    $newUrl = $this->cacheGoogleFont($href);
                    $newTag = str_replace($href, $newUrl, $tag);
                    return $newTag;
                } catch(Exception $e) {
                    if(WP_DEBUG) throw $e;
                    return $tag;
                }
            }


            return $tag;
        }

        public function cacheGoogleFont($url) {
            $userAgent = $_SERVER['HTTP_USER_AGENT'];

            // get stylesheet
            $content = wp_remote_get($url, array(
                'user-agent' => $userAgent
            ));
            $content = $content['body'];

            try {
                $cacheDir = $this->determineCacheDir($url, $userAgent);
                $url = $this->retreiveFontsByCSS($content, $cacheDir, $userAgent);
            } catch (Exception $e) {
                if(WP_DEBUG) throw $e;
                return $url;
            }

            return $url;
        }

        protected function determineCacheDir($contentBase, $salt) {
            $cacheDir = implode(DIRECTORY_SEPARATOR, array(
                WP_CONTENT_DIR,
                'cache',
                'GoogleFontCacher-'. md5(implode(DIRECTORY_SEPARATOR, array(
                    $contentBase,
                    $salt
                )))
            ));

            if(file_exists($cacheDir)) {
                if(!is_dir($cacheDir)) {
                    throw new Exception('Cache path exists but is a file');
                }
            } else {
                wp_mkdir_p($cacheDir);
            }

            return $cacheDir;
        }

        protected function determineCachePath($contentBase, $salt) {

        }

        protected function retreiveFontsByCSS($css, $saveToDir, $userAgent) {
            $pattern = '/url\((.*)\)/mU';

            if(preg_match_all($pattern, $css, $matches, PREG_SET_ORDER, 0)) {
                $information = array();

                foreach($matches as $match) {
                    $fileContent = wp_remote_get($match[1], array(
                        'user-agent' => $userAgent
                    ));

                    $fileName = basename($match[1]);
                    $savePath = implode(DIRECTORY_SEPARATOR, array(
                        $saveToDir,
                        $fileName
                    ));

                    file_put_contents($savePath, $fileContent['body']);

                    $information[] = array(
                        $match,
                        $fileName
                    );
                }

                // all downloaded, create new css
                $newCss = $css;
                foreach($information as $chunk) {
                    $fontFilePath = implode(DIRECTORY_SEPARATOR, array(
                        $saveToDir,
                        $chunk[1]
                    ));

                    $fontFileUrl = str_replace(WP_CONTENT_DIR, WP_CONTENT_URL, $fontFilePath);
                    $newCss = str_replace($chunk[0][1], $fontFileUrl, $newCss);
                }

                $cssFilePath = implode(DIRECTORY_SEPARATOR, array(
                    $saveToDir,
                    'fonts.css'
                ));
                file_put_contents($cssFilePath, $newCss);

                return str_replace(WP_CONTENT_DIR, WP_CONTENT_URL, $cssFilePath);
            } else {
                throw new Exception('Pattern did not found anything');
            }

        }
    }

    $plugin = new GoogleFontCacher();
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=11">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio of AMYTOA</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap-theme.min.css'); ?>"/>
    <link rel="stylesheet" type="text/css"
          href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo element('layout_skin_url', $layout); ?>/css/style.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo element('layout_skin_url', $layout); ?>/css/default.css"/>

    <link rel="stylesheet" type="text/css"
          href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/ui-lightness/jquery-ui.css"/>

    <?php echo $this->managelayout->display_css(); ?>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
    <script type="text/javascript">
        // 자바스크립트에서 사용하는 전역변수 선언
        var cb_url = "<?php echo trim(site_url(), '/'); ?>";
        var cb_cookie_domain = "<?php echo config_item('cookie_domain'); ?>";
        var cb_charset = "<?php echo config_item('charset'); ?>";
        var cb_time_ymd = "<?php echo cdate('Y-m-d'); ?>";
        var cb_time_ymdhis = "<?php echo cdate('Y-m-d H:i:s'); ?>";
        var is_member = "";
        var cb_device_type = "<?php echo $this->myconfig->get_device_type() === 'mobile' ? 'mobile' : 'desktop' ?>";
        var cb_csrf_hash = "<?php echo $this->security->get_csrf_hash(); ?>";
    </script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/basic.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/common.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.validate.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.validate.extension.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/sideview.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/js.cookie.js'); ?>"></script>
    <script src="https://kit.fontawesome.com/cde80c3577.js" crossorigin="anonymous"></script>
    <?php echo $this->managelayout->display_js(); ?>
</head>
<body>
<div class="wrapper">
    <div class="header animate-3" id="header">
        <a href="#home">HOME</a>
        <ul>
            <li><a href="#about">ABOUT</a></li>
            <li><a href="#portfolio">PORTFOLIO</a></li>
            <li><a href="#contact">CONTACT</a></li>
        </ul>
    </div>
    <!-- 본문 시작 -->
    <?php if (isset($yield)) echo $yield; ?>
    <!-- 본문 끝 -->
    <script type="text/javascript">
        var scroll_event = false;
        var scroll_idx = 0;

        (function () {
            $('html').on('mousewheel', function(e){
                //e.preventDefault();
                e.stopPropagation();

                var wheel = e.originalEvent.wheelDelta;
                var h = $('.content#home').height()+1;

                if(wheel>1 && scroll_event == false && scroll_idx >= 1){
                    scroll_event = true;
                    scroll_idx--;
                    $('html, body').stop().animate(
                        {
                            scrollTop:h*scroll_idx
                        },
                        {
                            duration:50,
                            complete: function(){
                                scroll_event = false;
                            }
                        });
                }else if(wheel<1 && scroll_event==false && scroll_idx < 4) {
                    scroll_event = true;
                    scroll_idx++;
                    $('html, body').stop().animate(
                        {
                            scrollTop:h*scroll_idx
                        },
                        {
                            duration:50,
                            complete: function(){
                                scroll_event = false;
                            }
                        });
                }
            });
        })(jQuery);
    </script>
</div>
</body>
</html>
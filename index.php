
<?php
require_once 'inc/bootstrap.php';
require_once 'include/functions.php';

// Ensure no output before headers
ob_start();
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <base href="<?= BASE_PREFIX ?>">
    <meta charset="UTF-8">
    <link rel="icon" href="/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PC游戏平台</title>
    
    <!-- Local jQuery -->
    <script src="<?= asset('js/jquery.min.js') ?>"></script>
    
    <!-- Main CSS -->
    <link rel="stylesheet" href="<?= asset('index-mqTVirNo.css') ?>">
    
    <!-- App initialization -->
    <script src="<?= asset('js/app-init.js') ?>"></script>
    <script src="<?= asset('js/i18n.js') ?>"></script>
    <script src="<?= asset('js/auth.js') ?>"></script>
</head>
<body>
    <div id="app" data-v-app="">
        <div data-v-8133d3e7="" class="layout">
            <div data-v-8133d3e7="" class="container">
                <!-- Header -->
                <div data-v-8133d3e7="" class="el-affix" style="height: 80px; width: 800px;">
                    <div class="el-affix--fixed" style="height: 80px; width: 800px; top: 0px; z-index: 100;">
                        <header class="header">
                            <div class="headerWrapper">
                                <!-- Logo -->
                                <div data-v-457ed486="" class="logo">
                                    <div data-v-457ed486="" class="bg">
                                        <img data-v-457ed486="" src="https://apis.meishi.bet/uploads/images/logo/pclogo.png">
                                    </div>
                                </div>
                                
                                <!-- Navigation Menu -->
                                <ul role="menubar" class="el-menu el-menu--horizontal menus" style="--el-menu-level: 0;">
                                    <li class="el-sub-menu" role="menuitem">
                                        <div class="el-sub-menu__title">
                                            <a aria-current="page" href="<?= url('') ?>" class="router-link-active router-link-exact-active">首页</a>
                                        </div>
                                    </li>
                                    <li class="el-sub-menu" role="menuitem">
                                        <div class="el-sub-menu__title">
                                            <a href="<?= url('category.php?code=live') ?>">视讯</a>
                                        </div>
                                    </li>
                                    <li class="el-sub-menu" role="menuitem">
                                        <div class="el-sub-menu__title">
                                            <a href="<?= url('category2.php?code=game') ?>">电子</a>
                                        </div>
                                    </li>
                                    <li class="el-sub-menu" role="menuitem">
                                        <div class="el-sub-menu__title">
                                            <a href="<?= url('category2.php?code=fishing') ?>">捕鱼</a>
                                        </div>
                                    </li>
                                    <li class="el-sub-menu" role="menuitem">
                                        <div class="el-sub-menu__title">
                                            <a href="<?= url('category.php?code=lottery') ?>">彩票</a>
                                        </div>
                                    </li>
                                    <li class="el-sub-menu" role="menuitem">
                                        <div class="el-sub-menu__title">
                                            <a href="<?= url('category.php?code=sport') ?>">体育</a>
                                        </div>
                                    </li>
                                    <li class="el-sub-menu" role="menuitem">
                                        <div class="el-sub-menu__title">
                                            <a href="<?= url('category2.php?code=poker') ?>">棋牌</a>
                                        </div>
                                    </li>
                                    <li class="el-sub-menu" role="menuitem">
                                        <div class="el-sub-menu__title">
                                            <a href="<?= url('category.php?code=esports') ?>">电竞</a>
                                        </div>
                                    </li>
                                </ul>
                                
                                <!-- Right side menu -->
                                <ul class="docAndDownload">
                                    <li>
                                        <div class="item">
                                            <a href="<?= url('discount.php') ?>">
                                                <p class="icon">
                                                    <i class="el-icon" style="font-size: 20px;">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1024 1024">
                                                            <path fill="currentColor" d="M224 704h576V318.336L552.512 115.84a64 64 0 0 0-81.024 0L224 318.336zm0 64v128h576V768zM593.024 66.304l259.2 212.096A32 32 0 0 1 864 303.168V928a32 32 0 0 1-32 32H192a32 32 0 0 1-32-32V303.168a32 32 0 0 1 11.712-24.768l259.2-212.096a128 128 0 0 1 162.112 0"></path>
                                                            <path fill="currentColor" d="M512 448a64 64 0 1 0 0-128 64 64 0 0 0 0 128m0 64a128 128 0 1 1 0-256 128 128 0 0 1 0 256"></path>
                                                        </svg>
                                                    </i>
                                                </p>
                                                <p>活动</p>
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="item">
                                            <a href="<?= url('cooperate.php') ?>">
                                                <p class="icon">
                                                    <i class="el-icon" style="font-size: 20px;">
                                                        <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" viewBox="0 0 1024 1024">
                                                            <path fill="currentColor" d="M918.4 201.6c-6.4-6.4-12.8-9.6-22.4-9.6H768V96c0-9.6-3.2-16-9.6-22.4C752 67.2 745.6 64 736 64H288c-9.6 0-16 3.2-22.4 9.6-6.4 6.4-9.6 16-9.6 22.4 3.2 108.8 25.6 185.6 64 224 34.4 34.4 77.56 55.65 127.65 61.99 10.91 20.44 24.78 39.25 41.95 56.41 40.86 40.86 91 65.47 150.4 71.9V768h-96c-9.6 0-16 3.2-22.4 9.6-6.4 6.4-9.6 12.8-9.6 22.4s3.2 16 9.6 22.4c6.4 6.4 12.8 9.6 22.4 9.6h256c9.6 0 16-3.2 22.4-9.6 6.4-6.4 9.6-12.8 9.6-22.4s-3.2-16-9.6-22.4c-6.4-6.4-12.8-9.6-22.4-9.6h-96V637.26c59.4-7.71 109.54-30.01 150.4-70.86 17.2-17.2 31.51-36.06 42.81-56.55 48.93-6.51 90.02-27.7 126.79-61.85 38.4-38.4 60.8-112 64-224 0-6.4-3.2-16-9.6-22.4zM256 438.4c-19.2-6.4-35.2-19.2-51.2-35.2-22.4-22.4-35.2-70.4-41.6-147.2H256zm390.4 80C608 553.6 566.4 576 512 576s-99.2-19.2-134.4-57.6C342.4 480 320 438.4 320 384V128h384v256c0 54.4-19.2 99.2-57.6 134.4m172.8-115.2c-16 16-32 25.6-51.2 35.2V256h92.8c-6.4 76.8-19.2 124.8-41.6 147.2zM768 896H256c-9.6 0-16 3.2-22.4 9.6-6.4 6.4-9.6 12.8-9.6 22.4s3.2 16 9.6 22.4c6.4 6.4 12.8 9.6 22.4 9.6h512c9.6 0 16-3.2 22.4-9.6 6.4-6.4 9.6-12.8 9.6-22.4s-3.2-16-9.6-22.4c-6.4-6.4-12.8-9.6-22.4-9.6"></path>
                                                        </svg>
                                                    </i>
                                                </p>
                                                <p>合营</p>
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="item">
                                            <a href="<?= url('app_download.php') ?>">
                                                <p class="icon">
                                                    <i class="el-icon" style="font-size: 20px;">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1024 1024">
                                                            <path fill="currentColor" d="M256 128a64 64 0 0 0-64 64v640a64 64 0 0 0 64 64h512a64 64 0 0 0 64-64V192a64 64 0 0 0-64-64zm0-64h512a128 128 0 0 1 128 128v640a128 128 0 0 1-128 128H256a128 128 0 0 1-128-128V192A128 128 0 0 1 256 64m128 128h256a32 32 0 1 1 0 64H384a32 32 0 0 1 0-64m128 640a64 64 0 1 1 0-128 64 64 0 0 1 0 128"></path>
                                                        </svg>
                                                    </i>
                                                </p>
                                                <p>APP</p>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                                
                                <!-- Login Bar -->
                                <div class="loginBar">
                                    <?php if (is_logged_in()): ?>
                                        <div class="user-info">
                                            <span>欢迎, <?= htmlspecialchars(current_user()['nickname'] ?? current_user()['username']) ?></span>
                                            <span class="balance"><?= format_currency(get_user_balance()) ?></span>
                                            <button class="el-button logout-btn">退出</button>
                                        </div>
                                    <?php else: ?>
                                        <form id="loginForm" class="login-form" style="display: inline-flex; gap: 10px;">
                                            <div class="el-input round" style="width: 90px;">
                                                <div class="el-input__wrapper">
                                                    <input class="el-input__inner" type="text" name="username" placeholder="账号" required>
                                                </div>
                                            </div>
                                            <div class="el-input round" style="width: 90px;">
                                                <div class="el-input__wrapper">
                                                    <input class="el-input__inner" type="password" name="password" placeholder="密码" required>
                                                </div>
                                            </div>
                                            <button type="submit" class="el-button el-button--primary round" style="margin-left: 10px;">
                                                <span>登录</span>
                                            </button>
                                            <button type="button" class="el-button round modal-trigger" data-target="#registerModal" style="margin-left: 10px;">
                                                <span>注册</span>
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                </div>
                                
                                <!-- Language selector -->
                                <div class="language">
                                    <div class="el-select round" style="width: 80px;">
                                        <div class="el-select__wrapper">
                                            <div class="el-select__selection">
                                                <div class="el-select__selected-item el-select__placeholder">
                                                    <span>zh-CN</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </header>
                    </div>
                </div>
                
                <!-- Main Content -->
                <main data-v-8133d3e7="" class="main">
                    <!-- Banner -->
                    <div data-v-16f05b83="" class="banner">
                        <div data-v-16f05b83="" class="bannerWrapper">
                            <div data-v-16f05b83="" class="banner_counter"></div>
                        </div>
                    </div>
                    
                    <!-- Announcement -->
                    <div data-v-ddf41b57="" class="announcement">
                        <div data-v-ddf41b57="" class="icon">
                            <img data-v-ddf41b57="" src="<?= asset('notice-BFxQjxhm.png') ?>">
                        </div>
                        <div data-v-ddf41b57="" class="text">视讯</div>
                        <div data-v-ddf41b57="" class="text">电子</div>
                        <div data-v-ddf41b57="" class="text">捕鱼</div>
                        <div data-v-ddf41b57="" class="text">彩票</div>
                        <div data-v-ddf41b57="" class="text">体育</div>
                        <div data-v-ddf41b57="" class="text">棋牌</div>
                        <div data-v-ddf41b57="" class="text">电竞</div>
                        <button class="el-button el-button--primary is-plain is-round btn">
                            <span>更多</span>
                        </button>
                    </div>
                    
                    <!-- App Download Section -->
                    <div class="appDownload">
                        <div class="title">
                            <div class="titleBg">APP下载</div>
                        </div>
                        <div data-v-d6ad6492="" class="appDownload__content">
                            <div data-v-d6ad6492="" class="img">
                                <img data-v-d6ad6492="" src="https://apis.meishi.bet/uploads/images/pc_img/202410/01/961d8417d81d48f3b1e2c55022cf4e34.png">
                            </div>
                            <div data-v-d6ad6492="" class="tutorial cBox bg_white">
                                <div data-v-d6ad6492="" class="btns">
                                    <div data-v-d6ad6492="" class="btn btn_ios actived">iOS App</div>
                                    <div data-v-d6ad6492="" class="btn btn_android">Android App</div>
                                </div>
                                <div class="textTitle">iOS APP</div>
                                <p class="textContent">
                                    作为基于云平台的服务，我们更加重视产品的安全性能。每一份数据都经过严格加密并多场景备份，防止危机发生。如果出现数据问题，可以及时恢复，让数据在云端更安全。
                                </p>
                                <div class="info">
                                    <div class="item">
                                        <div class="icon">
                                            <img src="data:image/png;base64,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">
                                        </div>
                                        <div class="text">
                                            <p>扫码下载</p>
                                            <p>支持iOS</p>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="icon">
                                            <img src="<?= asset('h5-DDnm2lPM.png') ?>">
                                        </div>
                                        <div class="text">
                                            <p>直接访问</p>
                                            <p>无需下载，手机输入网址即可</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- High Quality Service -->
                    <div data-v-74be09a3="" class="highQualityService">
                        <div data-v-74be09a3="" class="highQualityServiceTitle">
                            <div data-v-74be09a3="" class="titleBg">优质服务</div>
                        </div>
                        <div data-v-74be09a3="" class="items">
                            <div data-v-74be09a3="" class="item">
                                <div data-v-74be09a3="" class="title">
                                    <p data-v-74be09a3="" class="titleIcon">
                                        <img data-v-74be09a3="" src="https://apis.meishi.bet/uploads/images/pc_img/202410/01/02f370704a06ea0892f878ef281c5e52.png">
                                    </p>
                                    <p data-v-74be09a3="" class="titleText">平均存款时间</p>
                                </div>
                                <div data-v-74be09a3="" class="content">
                                    <p data-v-74be09a3="" class="contentIcon">
                                        <img data-v-74be09a3="" src="https://apis.meishi.bet/uploads/images/pc_img/202410/01/6c430d934b741ab2223692e1bc29d615.png">
                                    </p>
                                    <p data-v-74be09a3="" class="contentTitle">更专业</p>
                                    <p data-v-74be09a3="" class="contentText">
                                        每天为您提供近千场精彩体育、电竞赛事，玩法多元极致享受，更有真人、棋牌、彩票、电子游戏等多种娱乐方式随心选择。
                                    </p>
                                </div>
                            </div>
                            <!-- Additional service items... -->
                        </div>
                    </div>
                    
                    <!-- Partners -->
                    <div data-v-9e6a3e20="" class="image">
                        <div data-v-9e6a3e20="" class="title">
                            <div data-v-9e6a3e20="" class="titleBg">合作伙伴</div>
                        </div>
                        <div data-v-9e6a3e20="" class="img">
                            <a data-v-9e6a3e20="" href="#">
                                <div data-v-9e6a3e20="" class="imgHolder scale br10" style="background-image: url('https://apis.meishi.bet/uploads/images/pc_img/202410/01/becea77083a013eee1632a0113c1898a.png');"></div>
                            </a>
                        </div>
                    </div>
                </main>
                
                <!-- Footer -->
                <footer data-v-07831aa4="" class="footer">
                    <ul class="logos sm">
                        <li><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAALoAAABkCAMAAAAG5NqcAAAAIVBMVEVMaXGIj6eIkKiOmKyIj6eIj6eIj6eHjqZPjUtcAAAACnRSTlMAoVEQ8movytyIX3IbUAAAAAlwSFlzAAALEwAACxMBAJqcGAAAA+xJREFUeJztmu2WwygIhlH8QO7/gveIYkyTNrab3THn+P6Ypp02eSSAiAFYWlpaWlpaWlpaWlpaWlr6D4TBflZAmFHoI1/LGQuTCZPjQcW54APxFzIwj8Kwyavh8ankzBHmEH7lLUUJplD6npw5wATCr91lmlD1v5AzzxCp8Td0/9fcAPgb+QxJJvyITt05ktyCkLZ5thzaVOVLVNt0cLNUP7Lbj1E/u5L9Ed1153AyDs+sl8cSxobZZWlYp0Nisppn0bX/mdHU+2OUMp+gO2Vv6PUnRImNIzo5csXEgetBGs5eP6PjEd2SC6foECQ2DuievVUb+xI+lgn/AD2Eyn5AR3GwA3o2OemZUh5EcHX0t6C7cfR25Vd0f2p1n93INgeJbJG+mKcbus0eKfKAphFGfDO6U3QITu63ohtJMCayjOgFHZ24d6NFciUmvkQ3LVGKyzV2fJeFztEru6JLgnGOjNC9oIvR84uaPbivCgxF9216Kr9Wdnljx9HB5hv16jBFe3QsN6gzO5iv6oseHTp0Zffv2N+hC/sIelLn2Lz9JnRlt2/Y36LnmBxAx/KrndnvQr9gf4+ez/kG3VSFzeid2W9Dr+zunL27CElk+y0jJ1cm/pccnWrUOucBqZt6Yv2icTeg4yX73xfs/hzdXLJPi050xT4vOl+xT4zOF+wzo/Nn9qnR+SP73Oj8iX1ydP7A3qEns5Wq1mxTWioFI1idRMs8iu2NrqW95GJrdFGK8r1/h67ssWf3h0JA15WyPG4LbqstD09E5NjlFytLpnxERNo0LhUDRl1j68FPRW9roZZz128VdjzWMO1SnqmhRxe7Isa/9gvaoq4VO4o8Rt7Q036psa3qhF1bqsIeDugmqtkpGkW3nMpq+gN6LR+1TkPKJhztZii6s3nQxwUeMwW0bSTOYt0C2aHbWgZ6tg09r5lN4z1Hr0VnKzGR2JrRpdK28NwMLU2fK+3QIZbimyIounQpOrP7M3R/aB3QeBf5lmaGgWJ2y7ahl97QZvYenWqGoV2Yisx47/4mdKBs9vynovvisJvZe/SaYTjnmz164jjcibkLPZOJ6Su6NuSMEp84TGtdNHTPEYe7SHehZ4uLwxf0avTO7P6InoNyh57Jxztgt7RLM4pnI0YUdFSjb2Y/C1OFrOi+zoC2dJz+lya1qfOoBKbrjb6Z/TTD1OZoQd86pWPsd2wNROH0JJ6bMmnsdoUNFZOWF7kl25TjKQ8j5f+FGBuvp4Ft5QdvyMBzt8HgwZuP+NwtX3juRjs8+PEGeO5DJfDgR3ngwQ9QwYMfW4MHPyz46Ec0l5aWlpaWlpaWlpaWlpaW4EL/AIDBesTtBZMkAAAAAElFTkSuQmCC"></li>
                        <li><img src="<?= asset('15-DzRccdTg.png') ?>"></li>
                        <li><img src="<?= asset('16-Dn_-QgpL.png') ?>"></li>
                        <li><img src="<?= asset('17-CLffHcpW.png') ?>"></li>
                    </ul>
                    
                    <div class="copyright1">
                        <p style="font-family:'ArialMT', 'Arial', sans-serif;"></p>
                        <p style="font-family:'PingFangSC-Regular', 'PingFang SC', sans-serif;"></p>
                    </div>
                    
                    <ul class="logos">
                        <li><img src="<?= asset('DM_20241002111212_029-CsXy4IfW.png') ?>"></li>
                    </ul>
                    
                    <ul class="links">
                        <li><a href="#">关于我们</a></li>
                        <li><a href="#">帮助中心</a></li>
                        <li><a href="#">售后服务</a></li>
                        <li><a href="#">配送与验收</a></li>
                        <li><a href="#">商务合作</a></li>
                        <li><a href="#">企业采购</a></li>
                        <li><a href="#">开放平台</a></li>
                        <li><a href="#">搜索推荐</a></li>
                        <li><a href="#">友情链接</a></li>
                    </ul>
                    
                    <div class="copyright2">
                        <p>版权所有 ©2010-2023 保留所有权</p>
                    </div>
                </footer>
            </div>
        </div>
    </div>
    
    <!-- Registration Modal -->
    <div id="registerModal" class="modal" style="display: none;">
        <div class="modal-backdrop"></div>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>用户注册</h4>
                    <button type="button" class="modal-close">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="registerForm">
                        <div class="form-group">
                            <input type="text" name="username" placeholder="用户名" required>
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" placeholder="密码" required>
                        </div>
                        <div class="form-group">
                            <input type="password" name="password_confirm" placeholder="确认密码" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="nickname" placeholder="昵称">
                        </div>
                        <button type="submit" class="el-button el-button--primary">注册</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>

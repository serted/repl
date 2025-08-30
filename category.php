<?php require_once 'inc/bootstrap.php'; ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>游戏分类 - PC游戏平台</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="assets/index-mqTVirNo.css">
    <script src="js/app-init.js"></script>
    <script src="js/i18n.js"></script>
    <script src="js/auth.js"></script>
</head>
<body>
    <div id="app" data-v-app="">
        <div data-v-8133d3e7="" class="layout">
            <div data-v-8133d3e7="" class="container">
                <?php include 'include/header.php'; ?>

                <main data-v-8133d3e7="" class="main">
                    <div class="game-category">
                        <h1>游戏分类</h1>
                        <?php
                        $category = $_GET['code'] ?? 'live';
                        $categories = [
                            'live' => '视讯',
                            'lottery' => '彩票',
                            'sport' => '体育',
                            'esports' => '电竞'
                        ];
                        $categoryName = $categories[$category] ?? '游戏';
                        ?>
                        <h2><?= $categoryName ?></h2>
                        <div class="games-grid">
                            <p>该分类下的游戏正在加载中...</p>
                        </div>
                    </div>
                </main>

                <?php include 'include/footer.php'; ?>
            </div>
        </div>
    </div>
</body>
</html>
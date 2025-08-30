
<?php
require_once 'inc/bootstrap.php';
require_once 'include/functions.php';

$category_code = $_GET['code'] ?? 'live';
$category_names = [
    'live' => '视讯',
    'lottery' => '彩票', 
    'sport' => '体育',
    'esports' => '电竞'
];
$category_name = $category_names[$category_code] ?? '游戏';
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <base href="<?= BASE_PREFIX ?>">
    <meta charset="UTF-8">
    <link rel="icon" href="/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $category_name ?> - PC游戏平台</title>
    
    <script src="<?= asset('js/jquery.min.js') ?>"></script>
    <link rel="stylesheet" href="<?= asset('index-mqTVirNo.css') ?>">
    <script src="<?= asset('js/app-init.js') ?>"></script>
    <script src="<?= asset('js/i18n.js') ?>"></script>
    <script src="<?= asset('js/auth.js') ?>"></script>
</head>
<body>
    <div id="app" data-v-app="">
        <div class="layout">
            <div class="container">
                <!-- Include header -->
                <?php include 'include/header.php'; ?>
                
                <!-- Category content -->
                <main class="main">
                    <div class="category-header">
                        <h1><?= $category_name ?></h1>
                        <p>精选<?= $category_name ?>游戏</p>
                    </div>
                    
                    <div class="games-grid">
                        <?php 
                        $games = [
                            ['name' => 'DB真人', 'code' => 'DBZR', 'image' => 'https://apis.meishi.bet/uploads/images/apipicture/pc/DBZR.png'],
                            ['name' => '欧博视讯', 'code' => 'AB', 'image' => 'https://apis.meishi.bet/uploads/images/apipicture/pc/AB.png'],
                            ['name' => 'AG视讯', 'code' => 'AG', 'image' => 'https://apis.meishi.bet/uploads/images/apipicture/pc/AG.png'],
                            ['name' => '完美真人', 'code' => 'WMLIVE', 'image' => 'https://apis.meishi.bet/uploads/images/apipicture/pc/WMLIVE.png'],
                            ['name' => '沙龙SA', 'code' => 'SA', 'image' => 'https://apis.meishi.bet/uploads/images/apipicture/pc/SA.png'],
                            ['name' => 'SEXY性感真人', 'code' => 'SEXY', 'image' => 'https://apis.meishi.bet/uploads/images/apipicture/pc/SEXY.png'],
                            ['name' => 'BG真人', 'code' => 'BGZR', 'image' => 'https://apis.meishi.bet/uploads/images/apipicture/pc/BGZR.png'],
                            ['name' => 'WE真人', 'code' => 'WELIVE', 'image' => 'https://apis.meishi.bet/uploads/images/apipicture/pc/WELIVE.png'],
                            ['name' => 'EVO真人', 'code' => 'EVO', 'image' => 'https://apis.meishi.bet/uploads/images/apipicture/pc/EVO.png'],
                            ['name' => 'BET真人', 'code' => 'BET', 'image' => 'https://apis.meishi.bet/uploads/images/apipicture/pc/BET.png'],
                            ['name' => 'DG视讯', 'code' => 'DG', 'image' => 'https://apis.meishi.bet/uploads/images/apipicture/pc/DG.png']
                        ];
                        
                        foreach ($games as $game): ?>
                            <div class="game-card">
                                <div class="game-image">
                                    <img src="<?= $game['image'] ?>" alt="<?= $game['name'] ?>">
                                </div>
                                <div class="game-info">
                                    <h3><?= $game['name'] ?></h3>
                                    <button class="play-btn" data-game="<?= $game['code'] ?>">
                                        <?= $game['code'] ?>
                                    </button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </main>
                
                <!-- Include footer -->
                <?php include 'include/footer.php'; ?>
            </div>
        </div>
    </div>
    
    <style>
    .category-header {
        text-align: center;
        padding: 40px 0;
        background: white;
        border-radius: 15px;
        margin: 20px 0;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }
    
    .category-header h1 {
        font-size: 32px;
        color: #333;
        margin-bottom: 10px;
    }
    
    .games-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 20px;
        margin: 20px 0;
    }
    
    .game-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        transition: transform 0.3s;
    }
    
    .game-card:hover {
        transform: translateY(-5px);
    }
    
    .game-image {
        padding: 20px;
        text-align: center;
    }
    
    .game-image img {
        width: 100%;
        max-width: 150px;
        height: auto;
    }
    
    .game-info {
        padding: 0 20px 20px;
        text-align: center;
    }
    
    .game-info h3 {
        margin-bottom: 15px;
        color: #333;
    }
    
    .play-btn {
        background: linear-gradient(135deg, #409eff, #5dade2);
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 20px;
        cursor: pointer;
        font-weight: bold;
        transition: all 0.3s;
    }
    
    .play-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(64, 158, 255, 0.3);
    }
    </style>
</body>
</html>

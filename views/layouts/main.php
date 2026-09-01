<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\PatrimonialAsset;

PatrimonialAsset::register($this);

$this->beginPage();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title><?= Html::encode($this->title ?: 'ePan Patrimonial') ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <?php $this->head(); ?>
    <style>

.logout-form {
    margin: 0;
    padding: 0;
}

.logout-form button {
    width: 100%;
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 15px;
    border: none;
    background: transparent;
    color: #555;
    font-size: 14px;
    text-align: left;
    cursor: pointer;
}

.logout-form button:hover {
    background: #f5f5f5;
}

.logout-form i {
    width: 18px;
    text-align: center;
}
.user-menu {
    position: relative;
}

.user-menu-button {
    border: none;
    background: transparent;
    cursor: pointer;
}

.user-dropdown {
    display: none;
    position: absolute;
    top: calc(100% + 8px);
    right: 0;
    min-width: 180px;
    background: #fff;
    border: 1px solid #e5e5e5;
    border-radius: 10px;
    box-shadow: 0 5px 18px rgba(0, 0, 0, 0.12);
    padding: 6px 0;
    z-index: 9999;
}

.user-dropdown.show {
    display: block;
}

.user-dropdown a {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 15px;
    color: #555;
    text-decoration: none;
    font-size: 14px;
}

.user-dropdown a:hover {
    background: #f5f5f5;
}

.user-dropdown i {
    width: 18px;
    text-align: center;
}



       .header-menu-container {
    position: relative;
    display: inline-block;
}


.header-menu-panel {
    position: absolute;

    top: calc(100% + 8px);
    left: 0;

    width: 220px;

    background: #fff;

    border-radius: 12px;

    box-shadow: 0 8px 25px rgba(0,0,0,.18);

    padding: 8px;

    z-index: 9999;

    display: none;
}


body.menu-open .header-menu-panel {
    display: block;
}


.header-menu-panel a {
    display: flex;
    align-items: center;

    gap: 12px;

    padding: 12px 14px;

    color: #333;

    text-decoration: none;

    border-radius: 8px;
}


.header-menu-panel a:hover {
    background: #f2f4f7;
}


.header-menu-panel i {
    width: 22px;
    text-align: center;
}
    </style>
    <script>

        document.addEventListener('DOMContentLoaded', function () {

    const button = document.getElementById('userMenuButton');
    const dropdown = document.getElementById('userDropdown');

    button.addEventListener('click', function (e) {
        e.stopPropagation();
        dropdown.classList.toggle('show');
    });

    document.addEventListener('click', function () {
        dropdown.classList.remove('show');
    });

});


        document.addEventListener('click', function (event) {

    const menu =
        document.querySelector('.header-menu-container');

    if (!menu) return;

    if (!menu.contains(event.target)) {

        document.body.classList.remove('menu-open');

    }

});
    </script>
</head>
<body>
<?php $this->beginBody(); ?>

<div class="app-shell">
    


    <?php if ($this->context->route !== 'site/login'): ?>

        <header class="app-header">
            <div class="header-left">

                <?php if ($this->context->route !== 'patrimonial/index'): ?>

                    <a class="header-back" href="<?= Url::to(['patrimonial/index']) ?>">
                        <i class="fa-solid fa-arrow-left"></i>
                    </a>

                <?php else: ?>

                    <div class="header-menu-container">

                        <button
                            class="header-menu"
                            onclick="document.body.classList.toggle('menu-open')"
                        >
                            <i class="fa-solid fa-bars"></i>
                        </button>

                        <div class="header-menu-panel">                            
                            <a href="<?= Yii::$app->request->baseUrl ?>/index.php?r=relevamientopat%2F">
                                <i class="fa-solid fa-clipboard-list"></i>
                                <span>Relevamientos</span>
                            </a>

                            <a href="<?= Yii::$app->request->baseUrl ?>/index.php?r=epan_historial_escaneo%2F">
                                <i class="fa-solid fa-barcode"></i>
                                <span>Escaneos</span>
                            </a>
                            
                         
                        </div>

                    </div>

                <?php endif; ?>

                <div class="brand">
                    <strong>ePan</strong> <span>Patrimonial</span>
                </div>

            </div>

            <div class="header-actions">
                <div class="user-menu">
                    <button type="button" class="header-icon user-menu-button" id="userMenuButton">
                        <i class="fa-regular fa-user"></i>
                    </button>

                    <div class="user-dropdown" id="userDropdown">
                        <a href="<?= Url::to(['patrimonial/cuenta']) ?>">
                            <i class="fa-regular fa-user"></i>
                            <span>Mi cuenta</span>
                        </a>

                        <form action="<?= Url::to(['site/logout']) ?>" method="post" class="logout-form">
                            <input type="hidden"
                                name="<?= Yii::$app->request->csrfParam ?>"
                                value="<?= Yii::$app->request->getCsrfToken() ?>">

                            <button type="submit">
                                <i class="fa-solid fa-right-from-bracket"></i>
                                <span>Cerrar sesión</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </header>

    <?php endif; ?>



    <main class="app-content">
        <?= $content ?>
    </main>

    <?php if ($this->context->route !== 'site/login'): ?>

        <nav class="bottom-nav">

            <a href="<?= Url::to(['patrimonial/index']) ?>"
            class="<?= $this->context->route === 'patrimonial/index' ? 'active' : '' ?>">
                <i class="fa-solid fa-house"></i>
                <span>Inicio</span>
            </a>

            <a href="<?= Url::to(['patrimonial/historial']) ?>"
            class="<?= $this->context->route === 'patrimonial/historial' ? 'active' : '' ?>">
                <i class="fa-solid fa-clock-rotate-left"></i>
                <span>Historial</span>
            </a>
            <a href="<?= Url::to(['relevamientopat/index']) ?>"
                class="<?= $this->context->route === 'relevamientopat/index' ? 'active' : '' ?>">
                    <i class="fa-solid fa-clipboard-list"></i>
                    <span>Relevamientos</span>
            </a>           
            <a href="<?= Url::to(['patrimonial/cuenta']) ?>"
            class="<?= $this->context->route === 'patrimonial/cuenta' ? 'active' : '' ?>">
                <i class="fa-regular fa-user"></i>
                <span>Cuenta</span>
            </a>

        </nav>

    <?php endif; ?>




</div>

<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>

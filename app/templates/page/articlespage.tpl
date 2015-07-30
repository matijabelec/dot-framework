<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {@META-DATA}
    <title>{@head-title}</title>
    <link rel="stylesheet" href="{@SITE}/css/style.css">
    <link rel="stylesheet" href="{@SITE}/css/style-col.css">
</head>
<body>
    <header id="header">
        <span>{@header-title}</span>
    </header>

    <nav id="nav">
        <ul class="main-nav">
            <li><a href="{@ROOT}/test">{@nav-home}</a></li>
            <li><a href="{@ROOT}/test/about">{@nav-about}</a></li>
        </ul>
        
        <ul class="nav-langselect">
            <li><a href="{@ROOT}/lang/en?ret={@nav-lang-retlink}">en</a></li>
            <li><a href="{@ROOT}/lang/hr?ret={@nav-lang-retlink}">hr</a></li>
        </ul>
    </nav>
    <main id="main">
        <div class="main-region">
            <div class="col2-left-container">
                {@articles}
            </div><div class="col2-right-container">
                <div class="ads-container-right">
                    <div>
                        <h3>Ad title</h3>
                        <p>Ad text</p>
                    </div>
                    <div>
                        <h3>Ad2 title</h3>
                        <p>Ad2 text</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer id="footer">
        <p>&copy; 2015. <a href="http://matijabelec.com/">Matija Belec</a>. {@rights}.</p>
    </footer>
{@JS-DATA}
</body>
</html>
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
    {@HEADER}
    {@NAV}
    <main id="main">
        <div class="main-region">
            <div class="col2-left-container width-80 width-hd-70">
                <h2>Main region 1</h2>
            </div><div class="col2-right-container width-20 width-hd-30">
                <div class="ads-container-right">
                    <div>
                        <h3>Ad title</h3>
                        <img src="" alt="[ad-1-image]"/>
                        <p>Ad text</p>
                    </div>
                    <div>
                        <h3>Ad2 title</h3>
                        <img src="" alt="[ad-2-image]"/>
                        <p>Ad2 text</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="main-region">
            <div class="col2-left-container width-70">
                <h2>Main region 2</h2>
            </div><div class="col2-right-container width-30">
                <section id="section-more-from-projects">
                    <h2>{@more-projects}</h2>
                    <section>
                        <h3 class="project-name">{@project-status-name}</h3>
                        {@articles}
                    </section>
                </section>
            </div>
        </div>
        
        <div class="main-region">
            <div class="col3-left-container width-pc-20 width-hd-70">
                <h2>Main region 3 - left</h2>
            </div><div class="col3-middle-container width-pc-40 width-hd-10">
                <h2>Main region 3 - middle</h2>
                {@content-mid}
            </div><div class="col3-right-container width-pc-40 width-hd-20">
                <h2>Right</h2>
            </div>
        </div>
    </main>
    {@FOOTER}
{@JS-DATA}
</body>
</html>
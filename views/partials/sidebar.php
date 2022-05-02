<div class="col-md-4" data-sticky_column>
                <div class="primary-sidebar">

                    <aside class="widget">
                        <h3 class="widget-title text-uppercase text-center">Популярные статьи</h3>
                        <?php foreach ($popularArticles as $article): ?>
                            <div class="popular-post">


                                <a href="<?= \yii\helpers\Url::toRoute(['site/single', 'id' => $article->id]) ?>" class="popular-img"><img src="<?= $article->getImage() ?>" alt="">

                                    <div class="p-overlay"></div>
                                </a>

                                <div class="p-content">
                                    <a href="<?= \yii\helpers\Url::toRoute(['site/single', 'id' => $article->id]) ?>" class="text-uppercase"><?= $article->title ?></a>
                                    <span class="p-date"><?= $article->getDate($article->date) ?></span>

                                </div>
                            </div>
                        <?php endforeach; ?>
                    </aside>
                    <aside class="widget pos-padding">
                        <h3 class="widget-title text-uppercase text-center">Последние статьи</h3>
                        <?php foreach ($recentArticles as $article): ?>
                            <div class="thumb-latest-posts">


                                <div class="media">
                                    <div class="media-left">
                                        <a href="<?= \yii\helpers\Url::toRoute(['site/single', 'id' => $article->id]) ?>" class="popular-img"><img src="<?= $article->getImage() ?>" alt="">
                                            <div class="p-overlay"></div>
                                        </a>
                                    </div>
                                    <div class="p-content">
                                        <a href="<?= \yii\helpers\Url::toRoute(['site/single', 'id' => $article->id]) ?>" class="text-uppercase"><?= $article->title ?></a>
                                        <span class="p-date"><?= $article->getDate($article->date); ?></span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </aside>
                    <aside class="widget border pos-padding">
                        <h3 class="widget-title text-uppercase text-center">Categories</h3>
                        <ul>
                            <?php foreach ($categories as $category): ?>
                                <li>
                                    <a href="<?= \yii\helpers\Url::toRoute(['site/category', 'id' => $article->category->id]) ?>"><?= $category->title ?></a>
                                    <span class="post-count pull-right"> (<?= $category->getArticlesCount() ?>)</span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </aside>
                </div>
            </div>
<?phpreturn array(	'news/([a-z-]+)/([a-z-]+)-([0-9]+)' => 'news/view/$1/$2-$3',	'news/([a-z-]+)' => 'news/category/$1',	'news' => 'news/index',	'catalog/([a-z-]+)/page-([0-9]+)' => 'catalog/category/$1/$2',	'catalog/([a-z-]+)/([a-z-]+)-([0-9]+)' => 'catalog/view/$1/$2-$3',	'catalog/([a-z-]+)' => 'catalog/category/$1',	'catalog' => 'catalog/index',	'user/register' => 'user/register',	'user/login' => 'user/login',	'user/logout' => 'user/logout',	'cabinet/edit' => 'cabinet/edit',	'cabinet' => 'cabinet/index',	'' => 'site/index');
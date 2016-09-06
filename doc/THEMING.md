Theming system of QPS Service Desk uses standart for symfony twig engine for render project templates, but have some
individual properties:

1. All theme components(twig templates, css, individual js used for decoration) stored in themes directory in project.
   Themes directory defined in properties.yml with name "theme_dir", all available themes, include default theme must be
   placed in this directory.

   a. Standart theme structure has 3 folders(templates,css,js) and configure .ini file(more below in the text).

   b. All templates in theme system have cascade hierarchy. Most priority templates placed in app\Resources\Views of
      project, we call it "individual project redeclaration". It's need for redeclaration some vendor themes templates
      without change code directly in theme. Low priority have selected theme, it's redeclare templates of default
      theme(not redeclared templates using from default theme). Lowest priority have default theme, they base of theme
      system, and must include all possible in project templates. Besides theme can be inheritance by another theme,
      then not rediclare in child theme templates was taken from parent theme.

   c. For use some template in project, you must get it from ThemeBundel Default controller, using "forward" method.
      Example: $this->forward('JustOpenThemeBundle:Default:layoutMail', array('subject' => 'Hello', 'body' => 'world')),
      where 'layoutMail' relative path to template.
      ATENTION! Camalize naming in path name used for nested of templates, 'layoutModel' means template placed in
      "layout/mail.html.twig". Don't use camalize naming in template names!

2. Selecting themes has two ways: 1. From console command "qps:theme:select name_of_theme", where "name_of_theme"
   replaced by real theme machine name what you want select. 2. From Sevice Desk configure by address "settings/themes".

   a. Machine name of theme equal it's dir name.

   b. We recomending use first method, cause it's more secure for sable work of Service Desk

3. Configuration .ini file define properties of theme

   a. name - Human name of theme

   b. description - Short description of theme

   c. thumb - Thumb icon preview of theme

   d. favicon - Favicon of theme

   e. parent - Parent theme if exists

   f. css - Section of css paremeters

   g. js - Section of js paremeters
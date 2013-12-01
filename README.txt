-- 29 nov 2k13 - 12:38pm
initial change push. 

-- Options Framework fields can be added modified from > theme\admin\functions\functions.options.php 
----- found this after a lot of searching!
-------
------- $bg_images_url and $bg_images_path store the url to pattern background iamges  http://i.imgur.com/Ax6jri5.jpg

--- added google fonts to header.php 
--- icons for custom ThemeOption tabs can be added from /admin-style.css . the icon should be in admin/assets/images folder of theme options.

-- hidden smof_footer_info in admin-style.css to not show teh SMOF credit text at bottom of ThemeOptions tabs
-- Updated the stylesheet reader code in functions.options.php so it fetches the alternate css files from root of theme folder instaed of the /admin/layouts area.

---The stylesheet selector in Theme Options should control which style1.css or style2.css etc are added in the header. this happesn on the fly. ThemeOptions by default looks for these stylesehets in admin/layout folder, i've modified it so the files are picked up from theme root. Also add JS to remove the second instance of stylesheet that the parent theme adds automatically for this child theme. need that removed so that if style2.css is selected in theme options, the auto-added style.css shouldnt override all its css rules
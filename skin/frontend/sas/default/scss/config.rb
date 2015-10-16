# note: this should never truly be refernced since we are using relative assets
add_import_path "../../../rwd/default/scss"  
http_path = "/skin/frontend/sas/default/"
css_dir = "../css"
sass_dir = "../scss"
images_dir = "../images"
javascripts_dir = "../js"
relative_assets = true

output_style = :expanded
environment = :production


line_comments = false
cache = true
color_output = false # required for mixture

Sass::Script::Number.precision = 7 # chrome needs a precision of 7 to round properly
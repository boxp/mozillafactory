# syntax:
preferred_syntax = :scss

# Require any additional compass plugins here.

# Set this to the root of your project when deployed:
http_path = "/"
css_dir = "/"
sass_dir = "/"
images_dir = "img"
javascripts_dir = "js"
http_fonts_dir = "font"

if environment === :development then
  output_style = :expanded
  line_comments = true
  sass_options = {:debug_info => false, :cache => true}
else
  output_style = :compact
  line_comments = false
  sass_options = {:debug_info => false, :cache => false}
end

# You can select your preferred output style here (can be overridden via the command line):
# output_style = :expanded or :nested or :compact or :compressed

# To enable relative paths to assets via compass helper functions. Uncomment:
# relative_assets = true

# To disable debugging comments that display the original location of your selectors. Uncomment:
# line_comments = false

# If you prefer the indented syntax, you might want to regenerate this
# project again passing --syntax sass, or you can uncomment this:
# preferred_syntax = :sass
# and then run:
# sass-convert -R --from scss --to sass sass scss && rm -rf sass && mv scss sass

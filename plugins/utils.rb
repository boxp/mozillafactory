require "sass"

module FactoryFunctions
    def get_prefix(prop_name)
        assert_type prop_name, :String

        retVal = ""
        if (prop_name.value.index("-webkit-") === 0) then
            retVal = "webkit"
        elsif (prop_name.value.index("-o-") === 0) then
            retVal = "o"
        elsif (prop_name.value.index("-moz-") === 0) then
            retVal = "m"
        elsif (prop_name.value.index("-ms-") === 0) then
            retVal = "ie"
        end

        Sass::Script::String.new(retVal)
    end
end

module Sass::Script::Functions
    include FactoryFunctions
end

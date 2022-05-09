export default {

    methods: {

        getCookieMixin(name, type) {
            let value = this.$cookies.get(name);

            if (type == "boolean") {
                this[name] = this.getBoolMixin(value);

            }
        },

        getBoolMixin(val) {
            return !!JSON.parse(String(val).toLowerCase());
        },


    }

}

export default {

    methods: {

        fetchAllCookbooksMixin() {
            this.$axios
                .get("/api/cookbooks/all")
                .then((response) => {
                    this.cookbooks = response.data;
                })
                .catch((error) => {
                    this.messages = error.response.data;
                });
        },

    }
}


export default {

    methods: {

        fetchMealsMixins(page = 1) {
            this.$axios
                .get("/api/meals?page=" + page)
                .then((response) => {
                    this.meals = response.data;
                })
                .catch((error) => { });
        },

        fetchMealsByFilterMixin(filter, page = 1) {
            this.$axios
                // Via POST, not GET
                .post("/api/meals/filter?page=" + page, filter)
                .then((response) => {
                    this.meals = response.data;
                })
                .catch((error) => {
                    if (error.response.status == 422) {
                        this.errors = error.response.data.errors;
                    }
                });
        },

        deleteMealMixin(id) {

            this.$axios
                .delete("/api/meals/" + id)
                .then((response) => {
                    let index = this.meals.findIndex((obj) => obj.id == id);
                    this.meals.splice(index, 1);
                    this.messages = response.data;
                })
                .catch((error) => { });
        }
    }
}

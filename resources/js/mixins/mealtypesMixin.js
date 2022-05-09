
export default {

    methods: {

        fetchAllMealtypesMixin() {
            this.$axios
                .get("/api/mealtypes/all")
                .then((response) => {
                    this.mealtypes = response.data;
                })
                .catch((error) => {
                    this.messages = error.response.data;
                });
        },


    }
}

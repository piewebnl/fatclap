import moment from 'moment';


export default {

    methods: {

        showPrettyDateMixin(date) {
            return moment(date, "YYYY-MM-DD HH:mm:ss").format('ddd DD MMM');
        },

        showFullDateMixin(date) {
            return moment(date, "YYYY-MM-DD HH:mm:ss").format('DD-MM-YYYY');
        },

        getCurrentDateMixin() {
            var myDate = new Date();
            return moment(myDate).format('YYYY-MM-DD');
        },

        addDaysMixin(date, number) {
            var myDate = new Date(date);
            myDate.setDate(myDate.getDate() + number);
            return moment(myDate).format('YYYY-MM-DD');
        },

        subtractDaysMixin(date, number) {
            var myDate = new Date(date);
            myDate.setDate(myDate.getDate() - number);
            return moment(myDate).format('YYYY-MM-DD');
        },

        nextDayMixin(date) {
            return this.addDaysMixin(date, 1);
        },

        previousDayMixin(date) {
            return this.subtractDaysMixin(date, 1);
        },


    }
}

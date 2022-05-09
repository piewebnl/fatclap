import Vue from "vue";
import Vuex from "vuex";
import axios from "axios";
import applyCaseMiddleware from 'axios-case-converter';

Vue.use(Vuex);

export default new Vuex.Store({

    state: {
        user: {},
        userLoggedIn: false,
        meals: [],
        messages: [],
        showNutritionCounter: false,
        tempMeal: {},

        // Meal (search) filters
        keyword: '',
        order: 'created_at',
        ascOrDesc: 'asc',
        mealtype: '',
        cookbook: '',
        isVegetarian: '',
    },

    actions: {

        loadUser({ commit }) {

            const axiosClient = applyCaseMiddleware(axios.create({ headers: { 'X-Requested-With': 'XMLHttpRequest' } }));
            axiosClient.get("/api/user")
                .then((response) => {
                    let user = response.data;
                    if (user.name !== undefined) {
                        commit('updateUser', user)
                    }
                })
                .catch((errors) => {
                    // console.log(errors)
                });
        },

    },


    mutations: {

        updateUser(state, payload) {
            state.user = payload;
        },
        updateUserLoggedIn(state, payload) {
            state.userLoggedIn = payload;
        },
        updateMeals(state, payload) {
            state.meals = payload;
        },
        updateKeyword(state, payload) {
            state.keyword = payload;
        },
        updateMessages(state, payload) {
            state.messages = payload;
        },
        updateSort(state, payload) {
            state.order = payload;
        },
        updateSortOrder(state, payload) {
            state.ascOrDesc = payload;
        },
        updateMealtype(state, payload) {
            state.mealtype = payload;
        },
        updateCookbook(state, payload) {
            state.cookbook = payload;
        },
        updateIsVegetarian(state, payload) {
            state.isVegetarian = payload;
        },
        updateShowNutritionCounter(state, payload) {
            state.showNutritionCounter = payload;
        },
        updateTempMeal(state, payload) {
            state.tempMeal = payload;
        },
    },

    getters: {
        vuexLoaded: state => state.vuexLoaded,
        user: state => state.user,
        userLoggedIn: state => state.userLoggedIn,
        meals: state => state.meals,
        messages: state => state.messages,
        order: state => state.order,
        isVegetarian: state => state.isVegetarian,
        keyword: state => state.keyword,
        ascOrDesc: state => state.ascOrDesc,
        mealtype: state => state.mealtype,
        cookbook: state => state.cookbook,
        showNutritionCounter: state => state.showNutritionCounter,
        tempMeal: state => state.tempMeal,
    }


})


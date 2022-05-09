import Cookbooks from '@/components/cookbooks/Cookbooks.vue';
import CookbookEdit from '@/components/cookbooks/CookbookEdit.vue';
import MenuWeekly from '@/components/menus/MenuWeekly.vue';
import MenuSelect from '@/components/menus/MenuSelect.vue';
import Meals from '@/components/meals/Meals.vue';
import MealEdit from '@/components/meals/MealEdit.vue';
import Mealtypes from '@/components/mealtypes/Mealtypes.vue';
import MealtypeEdit from '@/components/mealtypes/MealtypeEdit.vue';
import PageNotFound from '@/components/PageNotFound.vue';
import Options from '@/components/options/Options.vue';

// index, show
// create, edit
// store, update, destroy

export default {
    mode: 'history',
    routes: [
        { path: '/', component: MenuWeekly, name: 'menuitems.index' },

        { path: '/meals', component: Meals, name: 'meals.index' },
        { path: '/meals/create', component: MealEdit, name: 'meals.create' },
        { path: '/meals/edit/:id', component: MealEdit, name: 'meals.edit' },

        { path: '/menuselect/:date?', component: MenuSelect, name: 'meals.menuitems' },

        { path: '/mealtypes', component: Mealtypes, name: 'mealtypes.index' },
        { path: '/mealtypes/create', component: MealtypeEdit, name: 'mealtypes.create' },
        { path: '/mealtypes/edit/:id', component: MealtypeEdit, name: 'mealtypes.edit' },

        { path: '/cookbooks', component: Cookbooks, name: 'cookbooks.index' },
        { path: '/cookbooks/create', component: CookbookEdit, name: 'cookbooks.create' },
        { path: '/cookbooks/edit/:id', component: CookbookEdit, name: 'cookbooks.edit' },

        { path: '/options', component: Options, name: 'options.index' },

        { path: "*", component: PageNotFound, name: 'pagenotfound' },
    ]
}




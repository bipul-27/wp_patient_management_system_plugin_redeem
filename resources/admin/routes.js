import Dashboard from './Components/Dashboard.vue';
import CreateDoctor from './Components/CreateDoctor.vue';


export var routes = [
    {
        path: '/',
        name: 'dashboard',
        component: Dashboard,
        meta: {
            active_menu: 'dashboard'
        }
    },
    {
        path: '/create-doctor',
        name: 'create-doctor',
        component: CreateDoctor,
        meta: {
            active_menu: 'create-doctor'
        }
    }
    
    
];


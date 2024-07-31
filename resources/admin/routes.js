import Dashboard from './Components/Dashboard.vue';
import CreateDoctor from './Components/CreateDoctor.vue';
import PatientManagement from './Components/PatientManagement.vue';
import PatientDetails from './Components/PatientDetails.vue';
import CreatePatient from './Components/CreatePatient.vue';


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
    },
    {
        path: '/edit-doctor/:id',
        name: 'edit-doctor',
        component: CreateDoctor,
        meta: {
            active_menu: 'edit-doctor'
        }
    },
    {
        path: '/doctor/:id/patients',
        name: 'patient-management',
        component: PatientManagement,
        meta: {
            active_menu: 'patient-management'
        }
    },
    {
        path: '/doctor/:doctorId/patient/:id',
        name: 'patient-details',
        component: PatientDetails,
        meta: {
            active_menu: 'patient-details'
        }
    },
    {
        path: '/doctor/:id/create-patient',
        name: 'create-patient',
        component: CreatePatient,
        meta: {
            active_menu: 'create-patient'
        }
    },
    {
        path: '/doctors/:doctorId/patients/:patientId/edit',
        name: 'edit-patient',
        component: CreatePatient
    }
    
    
];


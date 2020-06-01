import Vue from 'vue';
import VueRouter from "vue-router";

Vue.use(VueRouter);

//Dash Overview
import BlankDash from "../components/dashboard/BlankDash.vue";
import DashOverview from "../components/dashboard/overview/DashOverview";

//Project
import ProjectCardList from "../components/dashboard/projects/ProjectCardList";
import ProjectDetails from "../components/dashboard/projects/ProjectDetails";

//Blog
import BlogList from "../components/dashboard/blog/BlogList";

//services
import ServicesList from "../components/dashboard/services/ServicesList";

//Users
import UsersList from "../components/dashboard/users/UsersList";
import UserProfile from "../components/dashboard/users/UserProfile";

const routes = [
    {
        path: '/dashboard',
        name: 'dashboard',
        component: BlankDash,
        children:[
            {
                path: 'overview',
                component: DashOverview
            },
            {
                path: 'projects',
                component: ProjectCardList
            },
            {
                path: 'project/:slag',
                component:ProjectDetails,
                props: true
            },
            {
                path: 'blog',
                component: BlogList
            },
            {
                path: 'services',
                component: ServicesList
            },
            {
                path: 'users',
                component: UsersList
            },
            {
                path: 'user/:username',
                name: 'user-detail',
                component: UserProfile,
                props: true
            },
        ]

    }
];

const router = new VueRouter({
    mode: 'history',
    routes
});

export default router;

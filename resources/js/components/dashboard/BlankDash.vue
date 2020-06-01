<template>
    <div class="container__wrapper">
        <router-view :key="$route.fullPath"></router-view>
    </div>
</template>

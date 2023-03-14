<template>
    <nav class="custom-wrapper" id="menu">
        <div class="pure-menu"></div>
        <ul class="container-flex list-unstyled">
            <li class="pure-menu-item">
                <router-link :to="{ name: 'Home' }" class="pure-menu-link c-gris-2 text-uppercase">Inicio
                </router-link>
            </li>
            <li class="pure-menu-item">
                <router-link :to="{ name: 'About' }" class="pure-menu-link c-gris-2 text-uppercase">Nosotros
                </router-link>
            </li>
            <li class="pure-menu-item">
                <router-link :to="{ name: 'Archive' }" class="pure-menu-link c-gris-2 text-uppercase">
                    Archivo
                </router-link>
            </li>
            <li class="pure-menu-item">
                <router-link :to="{ name: 'Contact' }" class="pure-menu-link c-gris-2 text-uppercase">
                    Contacto
                </router-link>
            </li>
        </ul>
    </nav>
</template>

<script>
export default {

}
</script>

<style></style>

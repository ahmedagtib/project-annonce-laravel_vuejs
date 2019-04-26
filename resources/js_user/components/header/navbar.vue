<template>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <router-link class="navbar-brand" to="/">vap</router-link>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <router-link class="nav-link" to="/">Accueil</router-link>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">A propos</a>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" to="/store">Annonces</router-link>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">contactez nous</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
</template>
<script>
export default {
    
}
</script>


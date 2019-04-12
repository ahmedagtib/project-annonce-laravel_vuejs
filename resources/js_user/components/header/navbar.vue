<template>
	 <nav class="navbar navbar-expand-lg navbar-light">
           <div class="container">
                 <a class="navbar-brand" href="#">vap</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                </button>
                 <div class="collapse navbar-collapse" id="navbarSupportedContent">
                       <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <router-link class="nav-link" to="/">Home</router-link>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">a propos</a>
                            </li>
                            <li class="nav-item">
                                <router-link class="nav-link" to="/store">annonce</router-link>
                            </li>
                            <li class="nav-item">
                                 <a class="nav-link" href="#">contact</a>
                            </li>
      
                       </ul>
                </div>
        </div>
      </nav>
</template>
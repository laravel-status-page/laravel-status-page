<template>
    <div>
        <navbar />

        <main>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <article>
                            <slot />
                        </article>
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>

<script>
import Navbar from '@/Shared/Navbar'

export default {
     components: {
         Navbar,
     }
}
</script>

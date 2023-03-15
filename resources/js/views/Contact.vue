<template>
    <section class="pages container">
        <div class="page page-contact">
            <h1 class="text-capitalize">Contacto</h1>
            <p>Nam in maximus arcu, ac aliquam tellus. Donec vestibulum ipsum nunc, at placerat ante posuere non. Integer at
                dui a lacus suscipit elementum id non massa. Pellentesque habitant morbi tristique senectus et netus et
                malesuada fames ac turpis egestas. Nunc eu neque eros. Ut eu quam justo.</p>
            <div class="divider-2" style="margin:25px 0;"></div>
            <div class="form-contact">
                <Transition name="slide-fade" mode="out-in">
                    <p v-if="sent">Tu Mensaje Ha Sido Enviado</p>
                    <form v-else @submit.prevent="submit">
                        <div class="input-container container-flex space-between">
                            <input v-model="form.name" type="text" placeholder="Nombre" class="input-name" required>
                            <input v-model="form.email" type="email" placeholder="Correo" class="input-email" required>
                        </div>
                        <div class="input-container">
                            <input type="text" v-model="form.subject" placeholder="Asunto" class="input-subject" required>
                        </div>
                        <div class="input-container">
                            <textarea v-model="form.message" name="" id="" cols="30" rows="10" placeholder="Tu Mensaje"
                                required></textarea>
                        </div>
                        <div class="send-message">
                            <button class="text-uppercase c-green" :disabled="working">
                                <span v-if="working">Enviando...</span>
                                <span v-else>Enviar Mensaje</span>
                            </button>
                        </div>
                    </form>
                </Transition>
            </div>
        </div>
    </section>
</template>

<script>
export default ({
    data() {
        return {
            sent: false,
            working: false,
            form: {
                name: 'uno',
                email: 'correouno@correo.com',
                subject: 'Titulo',
                message: 'Cuerpo de un correo',
            }
        }
    },
    methods: {
        submit() {
            this.working = true;
            axios.post('/api/message', this.form)
                .then(res => {
                    this.sent = true;
                    this.working = false;
                })
                .catch(err => {
                    this.sent = false;
                    this.working = false;
                })
        }
    }
})
</script>


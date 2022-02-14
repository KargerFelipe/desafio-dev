<template>
    <div class="container flex">
        <b-card
            bg-variant="dark"
            text-variant="white"
            title="Importe seu aquivo CNAB"
            class="my-2"
        >
            <b-form-file
                v-model="file"
                :state="Boolean(file)"
                placeholder="Escolha um arquivo ou arraste aqui"
                drop-placeholder="Arraste o arquivo aqui"
                accept="txt"
                @input="salvarArquivo"
            >
            </b-form-file>
            <hr>
            <div class="mt-3">Arquivo selecionado: {{ file ? file.name : "" }}</div>
        </b-card>
    </div>
</template>

<script>
export default {
    data() {
        return {
            file: null
        }
    },
    methods: {
        salvarArquivo(){
            let self = this
            let formData = new FormData();
            formData.append('cnab', self.file);

            axios.post('/operacoes',
                formData,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }
            )
        }
    }
};
</script>

<template>
    <admin-layout title="Admin">
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 leading-tight container"
            >
                Nuevo Usuario
            </h2>
        </template>

        <div class="py-2">
            <div class="container">
                <section class="container mx-auto p-6 font-mono">
                    <div
                        class="w-full mb-8 overflow-hidden bg-white rounded-lg shadow-lg"
                    >
                        <div class="w-full overflow-x-auto">
                            <form @submit.prevent="updateUser">
                                <div class="grid grid-cols-2 gap-8 p-4">
                                    <div>
                                        <jet-label
                                            for="firstname"
                                            value="Nombres"
                                        />
                                        <jet-input
                                            id="firstname"
                                            type="text"
                                            class="mt-1 block w-full"
                                            v-model="form.firstname"
                                            autofocus
                                            autocomplete="firstname"
                                            placeholder="nombres de usuario..."
                                        />
                                        <div
                                            class="text-sm text-red-400"
                                            v-if="form.errors.firstname"
                                        >
                                            {{ form.errors.firstname }}
                                        </div>
                                    </div>
                                    <div class="">
                                        <jet-label
                                            for="lastname"
                                            value="Apellidos"
                                        />
                                        <jet-input
                                            id="lastname"
                                            type="text"
                                            class="mt-1 block w-full"
                                            v-model="form.lastname"
                                            autofocus
                                            autocomplete="lastname"
                                            placeholder="apellidos de usuario..."
                                        />

                                        <div
                                            class="text-sm text-red-400"
                                            v-if="form.errors.lastname"
                                        >
                                            {{ form.errors.lastname }}
                                        </div>
                                    </div>

                                    <div class="">
                                        <jet-label for="dni" value="DNI" />
                                        <jet-input
                                            id="dni"
                                            type="text"
                                            class="mt-1 block w-full"
                                            v-model="form.dni"
                                            autofocus
                                            autocomplete="dni"
                                            placeholder="DNI de usuario..."
                                        />

                                        <div
                                            class="text-sm text-red-400"
                                            v-if="form.errors.dni"
                                        >
                                            {{ form.errors.dni }}
                                        </div>
                                    </div>
                                    <div class="">
                                        <jet-label
                                            for="direction"
                                            value="Direccion"
                                        />
                                        <jet-input
                                            id="direction"
                                            type="text"
                                            class="mt-1 block w-full"
                                            v-model="form.direction"
                                            autofocus
                                            autocomplete="direction"
                                            placeholder="Direccion de usuario..."
                                        />

                                        <div
                                            class="text-sm text-red-400"
                                            v-if="form.errors.direction"
                                        >
                                            {{ form.errors.direction }}
                                        </div>
                                    </div>
                                    <div class="">
                                        <jet-label
                                            for="medidor_id"
                                            value="Medidor"
                                        />
                                        <jet-input
                                            id="medidor_id"
                                            type="text"
                                            class="mt-1 block w-full"
                                            v-model="form.medidor_id"
                                            autofocus
                                            autocomplete="medidor_id"
                                            placeholder="Numero de medidor..."
                                        />

                                        <div
                                            class="text-sm text-red-400"
                                            v-if="form.errors.medidor_id"
                                        >
                                            {{ form.errors.medidor_id }}
                                        </div>
                                    </div>
                                </div>

                                <div class="flex items-center justify-end m-4">
                                    <jet-button
                                        class="ml-4"
                                        :class="{
                                            'opacity-25': form.processing,
                                        }"
                                        :disabled="form.processing"
                                    >
                                        Actualizar
                                    </jet-button>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </admin-layout>
</template>

<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { ref, watch, defineProps } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { SearchIcon } from "@heroicons/vue/outline";
import JetButton from "@/Jetstream/Button.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetLabel from "@/Jetstream/Label.vue";
import { useForm, Link } from "@inertiajs/inertia-vue3";

const props = defineProps({
    persona: Object,
    image: String,
});

const form = useForm({
    firstname: props.persona.first_name,
    lastname: props.persona.last_name,
    dni: props.persona.dni,
    direction: props.persona.direccion,
    medidor_id: props.persona.medidor_id,
});

function updateUser() {
    Inertia.post("/admin/usuarios/" + props.persona.id, {
        _method: "put",
        firstname: form.firstname,
        lastname: form.lastname,
        dni: form.dni,
        direccion: form.direction,
        medidor_id: form.medidor_id,
    });
}
</script>

<style></style>

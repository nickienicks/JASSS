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
                            <form @submit.prevent="storeUsers">
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
                                            disabled
                                            v-model="form.firstname"
                                            autofocus
                                            autocomplete="firstname"
                                            placeholder="nombres de usuario..."
                                        />
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
                                            disabled
                                            v-model="form.lastname"
                                            autofocus
                                            autocomplete="lastname"
                                            placeholder="apellidos de usuario..."
                                        />
                                    </div>

                                    <div class="">
                                        <jet-label for="dni" value="DNI" />
                                        <jet-input
                                            id="dni"
                                            type="text"
                                            class="mt-1 block w-full"
                                            disabled
                                            v-model="form.dni"
                                            autofocus
                                            autocomplete="dni"
                                            placeholder="DNI de usuario..."
                                        />
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
                                            disabled
                                            v-model="form.direction"
                                            autofocus
                                            autocomplete="direction"
                                            placeholder="Direccion de usuario..."
                                        />
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
                                            disabled
                                            v-model="form.medidor_id"
                                            autofocus
                                            autocomplete="medidor_id"
                                            placeholder="Numero de medidor..."
                                        />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div>
                        <h1 class="text-lg font-bold">Asignar Deuda</h1>
                    </div>
                    <div
                        class="w-full mb-8 overflow-hidden bg-white rounded-lg shadow-lg"
                    >
                        <div class="w-full overflow-x-auto">
                            <form @submit.prevent="storeDeuda">
                                <div class="grid grid-cols-2 gap-8 p-4">
                                    <div class="">
                                        <jet-label for="fecha" value="Fecha" />
                                        <jet-input
                                            id="fecha"
                                            type="date"
                                            class="mt-1 block w-full"
                                            v-model="form.fecha"
                                            autofocus
                                            autocomplete="fecha"
                                        />
                                        <div
                                            class="text-sm text-red-400"
                                            v-if="form.errors.fecha"
                                        >
                                            {{ form.errors.fecha }}
                                        </div>
                                    </div>
                                    <div class="">
                                        <jet-label for="monto" value="Monto" />
                                        <jet-input
                                            id="monto"
                                            type="text"
                                            class="mt-1 block w-full"
                                            v-model="form.monto"
                                            autofocus
                                            autocomplete="monto"
                                            placeholder="monto de deuda..."
                                        />

                                        <div
                                            class="text-sm text-red-400"
                                            v-if="form.errors.monto"
                                        >
                                            {{ form.errors.monto }}
                                        </div>
                                    </div>

                                    <div class="">
                                        <jet-label
                                            for="medida_ant"
                                            value="medida_ant"
                                        />
                                        
                                            <jet-input
                                                id="medida_ant"
                                                type="text"
                                                class="mt-1 block w-full"
                                                v-model="form.medida_ant"
                                                autofocus
                                                autocomplete="medida_ant"
                                                placeholder="medidada anterior..."
                                            />
                                        <div
                                            class="text-sm text-red-400"
                                            v-if="form.errors.medida_ant"
                                        >
                                            {{ form.errors.medida_ant }}
                                        </div>
                                    </div>
                                    <div class="">
                                        <jet-label
                                            for="medida_act"
                                            value="Medida_act"
                                        />
                                        <jet-input
                                            id="medida_act"
                                            type="text"
                                            class="mt-1 block w-full"
                                            v-model="form.medida_act"
                                            autofocus
                                            autocomplete="medida_act"
                                            placeholder="medida Actual..."
                                        />

                                        <div
                                            class="text-sm text-red-400"
                                            v-if="form.errors.medida_act"
                                        >
                                            {{ form.errors.medida_act }}
                                        </div>
                                    </div>
                                    <div class="">
                                        <jet-input
                                            id="persona_id"
                                            type="text"
                                            class="mt-1 w-full hidden"
                                            autofocus
                                            v-model="form.persona_id"
                                            autocomplete="persona_id"
                                        />
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
                                        Registrar Deuda
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
import { ref, watch, defineProps, computed } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { SearchIcon } from "@heroicons/vue/outline";
import JetButton from "@/Jetstream/Button.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetLabel from "@/Jetstream/Label.vue";
import { useForm, Link } from "@inertiajs/inertia-vue3";
import { objectExpression } from "@babel/types";
const props = defineProps({
    persona: Object,
    deudass :Object,
});
const form = useForm({
    firstname: props.persona.first_name,
    lastname: props.persona.last_name,
    dni: props.persona.dni,
    direction: props.persona.direccion,
    medidor_id: props.persona.medidor_id,
    fecha: "",
    monto: calcularMonto,
    medida_ant: "",
    medida_act: "",
    persona_id: props.persona.id,
});
/* const medidaant = computed(()=>{
    if(props.deudass === null){
            form.medida_ant= ""
        }else{
            form.medida_ant= props.deudass.medida_ant;
            
        }
}) */
const calcularMonto = computed(() => {
    let montoTotal=0 ;
    let montoResta=0 ;
    try {
        let resta = parseInt(form.medida_act) - parseInt(form.medida_ant);
        if (resta <= 7) {
            montoTotal = resta * 2;
        } else {
            if (resta > 20) {
                montoTotal = ((resta-7) * 3 )+14;
            } else {
                montoTotal = resta * 2;
            }
        }
        if(isNaN(montoTotal)){
            parseFloat(montoTotal);
            return montoTotal;
        }else{
            form.monto= montoTotal;
            return montoTotal;
        }
    } catch (error) {
        console.log(error);
    }
});
console.log(props.deudass);

 /* watch(form.medida_ant, (newValue, oldValue) => {
    if (props.deudass.length === null){
        console.log('aaa');
        form.medida_ant = props.deudass.medida_act;
    }
})   */


function storeDeuda() {
    form.post(`/admin/usuarios/${props.persona.id}/storedeudas`, {
        preserveScroll: true,
        onSuccess:()=>{form.reset('fecha','monto','medida_act','medida_ant');
        form.medida_ant= props.deudass.medida_act;},
        
    });
}
</script>

<style></style>
import {ref} from "vue";
import {useForm} from "@inertiajs/inertia-vue3";

export default function useOdontogram(){

    const teeth = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18]
    const col = ref('diente')

    const tratamientoodontoform = useForm({
        'anotaciones' : '',
        'classbtn1': '',
        'classbtn2': '',
        'classbtn3': '',
        'classbtn4': '',
        'classbtn5': '',
        'classbtn6': '',
        'classbtn7': '',
        'classbtn8': '',
        'classbtn9': '',
        'classbtn10': '',
        'classbtn11': '',
        'classbtn12': '',
        'classbtn13': '',
        'classbtn14': '',
        'classbtn15': '',
        'classbtn16': '',
        'classbtn17': '',
        'classbtn18': '',
        'area2': '',
        'idpaciente': '',
    });

    const teethmap = useForm({
        'canvar': '',
        'uuid': '',
        'patient_id': '',
    })

    const initialize = () => {

        $('#cerrar').click(function(){

            teeth.forEach((element) => {
                $(`.btn${element}`).text('');
                $(`.btn${element - 1}`).text($(`#ctext${element}`).val());
            })


            tratamientoodontoform.transform((data) => ({
                ...data,
                'classbtn1' : document.getElementsByName('classb1')[0].value,
                'classbtn2' : document.getElementsByName('classb2')[0].value,
                'classbtn3' : document.getElementsByName('classb3')[0].value,
                'classbtn4' : document.getElementsByName('classb4')[0].value,
                'classbtn5' : document.getElementsByName('classb5')[0].value,
                'classbtn6' : document.getElementsByName('classb6')[0].value,
                'classbtn7' : document.getElementsByName('classb7')[0].value,
                'classbtn8' : document.getElementsByName('classb8')[0].value,
                'classbtn9' : document.getElementsByName('classb9')[0].value,
                'classbtn10' : document.getElementsByName('classb10')[0].value,
                'classbtn11' : document.getElementsByName('classb11')[0].value,
                'classbtn12' : document.getElementsByName('classb12')[0].value,
                'classbtn13' : document.getElementsByName('classb13')[0].value,
                'classbtn14' : document.getElementsByName('classb14')[0].value,
                'classbtn15' : document.getElementsByName('classb15')[0].value,
                'classbtn16' : document.getElementsByName('classb16')[0].value,
                'classbtn17' : document.getElementsByName('classb17')[0].value,
                'classbtn18' : document.getElementsByName('classb18')[0].value,
                'area2' : $(".reglas").html()
            }))


            tratamientoodontoform.post(route('patients.odontogram.rules',tratamientoodontoform.idpaciente),{
                preserveScroll: true,
                onSuccess: () => { window.location.reload() }
            })
        })

        $('#propiedades').click(function(){
            teeth.forEach((element) => {
                // Clear Ctext
                $(`#ctext${element}`).val('');
                $("#ctext" + element).val($(`.btn${element - 1}`).text());
            })
        })

        let color='diente';

        ['',2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18].forEach((element) => {
            $(`#styleSpan${element}`).click(function(){
                col.value = $(this).attr('class');
                $( "td > svg" ).off( "click" );
            })
        })

        $('svg > polygon').click(function () {
            $(this).attr('class', col.value);
            teethmap.canvar =$(".sbox").html();
        });

    }

    const updateOdontogram = () => {
        teethmap.put(route('patients.odontogram.update', teethmap.uuid),{
            preserveScroll: true,
        })
    }

    return {
        initialize,
        updateOdontogram,
        teethmap,
        tratamientoodontoform
    }

}

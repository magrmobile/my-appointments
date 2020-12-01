let $doctor, $date, $specialty, $hours;
let iRadio;

const noHoursAlert = `<div class="alert alert-danger" role="alert">
<strong>Lo sentimos!</strong> No se encontraron horas disponibles para el medico en el dia seleccionado.
</div>`;

$(function() {
    $specialty = $('#specialty');
    $doctor = $('#doctor');
    $date = $('#date');
    $hours = $('#hours');

    $specialty.on("change", () => {
        const specialtyId = $specialty.val();
        const url = `/specialties/${specialtyId}/doctors`;
        $.getJSON(url, onDoctorsLoaded);
    });

    $doctor.on("change", loadHours);
    $date.on("change", loadHours);
});

function onDoctorsLoaded(doctors) {
    let htmlOptions = '';
    doctors.forEach(doctor => {
        htmlOptions += `<option value="${doctor.id}">${doctor.name}</option>`;
    });
    $doctor.html(htmlOptions);
    loadHours(); // side-effect
}

function loadHours() {
    const selectedDate = $date.val();
    const doctorId = $doctor.val();

    const url = `/schedule/hours?date=${selectedDate}&doctor_id=${doctorId}`;
    $.getJSON(url, displayHours);
}

function displayHours(data) {
    if (!data.morning && !data.afternoon) {
        $hours.html(noHoursAlert);
        return;
    }

    let htmlHours = ``;
    iRadio = 0;

    if (data.morning) {
        const morning_intervals = data.morning;
        morning_intervals.forEach(interval => {
            htmlHours += getRadioIntervalHtml(interval);
        });
    }

    if (data.afternoon) {
        const afternoon_intervals = data.afternoon;
        afternoon_intervals.forEach(interval => {
            htmlHours += getRadioIntervalHtml(interval);
        });
    }

    $hours.html(htmlHours);
}

function getRadioIntervalHtml(interval) {
    const text = `${interval.start} - ${interval.end}`;

    return `<div class="custom-control custom-radio mb-3">
    <input name="schedule_time" value="${interval.start}" id="interval${iRadio}" type="radio" class="custom-control-input">
    <label class="custom-control-label" for="interval${iRadio++}">${text}</label>
  </div>`;
}
//$("#job-form").submit(checkValues);
$("#job-form").submit(concatenateMajorInputs);
$("#btn-add-major-input").on("click", addMajorInput);
$("#btn-rem-major-input").on("click", removeMajorInput);

function checkValues() {
    debugger;
    date = $("#job-start-date").val();
    body = $("#job-body").val();
    employment = $("#job-employment").val();
    visa = $("#job-visa").val();
}

function concatenateMajorInputs() {
    majors = "";

    $("#job-majors").siblings().each(function() {
        major = this.value.trim();

        if (major != "")
            majors += ("\n" + major);
    });

    $("#job-majors").val(majors.trim());
}

function addMajorInput() {
    var html = '<input class="input-block-level" type="text" rows="1" maxlength="5000"></input>';
    $("#job-majors").siblings().last().after(html);
}

function removeMajorInput() {
    if ($("#job-majors").siblings().length === 1)
        return;

    $("#job-majors").siblings().last().remove();
}
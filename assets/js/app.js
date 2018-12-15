function inputUpperCase(input) {
  return input.value.toUpperCase()
}

function searchValue() {
  let td;
  let index;
  let textValue;

  let input = document.getElementById('contactInput');

  let filter = inputUpperCase(input)

  let tr = document.getElementsByTagName('tr');

  for (index = 0; index < tr.length; index++) {
    td = tr[index].getElementsByTagName('td')[1];
    
    if (td) {
      textValue = td.textContent || td.innerText;
  
      if (textValue.toUpperCase().indexOf(filter) > - 1) {
        tr[index].style.display = "";
      } else {
        tr[index].style.display = "none";
      }
    }
  }
}

function checkForm(form, button) {
  formElement = document.forms[form].elements;

  document.getElementById(button).disabled = formElement[1].value.length == 0;
}

function checkCreateForm() {
  checkForm('createContactForm', 'saveButton');
}

function checkUpdateForm() {
  checkForm('updateContactForm', 'updateButton');
}
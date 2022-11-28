function checkDate() {
  const dateSolicited = document.getElementById('dataSolicitada').value
  const radios   = document.querySelector('input[name=andares]:checked').value
  const today    = new Date()
  const tDay     = today.getDate()
  const tMonth   = today.getMonth() + 1
  const tYear    = today.getFullYear()
  const daySel   = dateSolicited.split('-')[2]
  const monthSel = dateSolicited.split('-')[1]
  const yearSel  = dateSolicited.split('-')[0]

  if(yearSel < tYear) {
    return alert('O ano selecionado precisa ser posterior ou igual à data atual')
  }
  
  if(monthSel < tMonth) {
    return alert('O mês selecionado precisa ser posterior ou igual à data atual')
  }
  
  if(daySel < tDay && monthSel <= tMonth) {
    return alert('O dia selecionado precisa ser posterior ou igual à data atual')
  }

  console.log(radios);

  switch(radios){
    case 1: {
      if(daySel == tDay) {
        alert('Seu bolo estará disponível para entrega em 3 horas')
      }
      break;
    }
    case 2: {
      if(daySel == tDay){
        alert('Seu bolo estará disponível para entrega em 5 horas')
      }
      break;
    }
    case 3: {
      if(daySel == tDay){
        alert('Agendamento indisponível. Seu bolo só poderá ser entregue a partir de amanhã')
      }
      break;
    }
    case 4: {
      if(daySel == tDay){
        alert('Agendamento indisponível. Seu bolo só poderá ser entregue a partir de amanhã')
      }
      break;
    }
  }
}

function valuesCalc(event) {
  let massaInput = document.getElementsByClassName('massaInput')
  let fillingInput = document.getElementsByClassName('fillingInput')
  let coverageInput = document.getElementsByClassName('coverageInput')
  let totalInput = document.getElementsByClassName('totalInput')
  
  switch(event.target.value) {
    case 'formigueiro': {
      massaInput.value.placeholder = 'massa - R$40'
      break;
    }
    case 'mesclado':
    case 'cenoura': {
      massaInput.value.placeholder = 'massa - R$30'
      break;
    }
    case 'laranja': {
      massaInput.value.placeholder = 'massa - R$20'
      break;
    }
    case 'chocolate': 
    case 'coco':{
      fillingInput.value.placeholder = 'recheio - R$5'
      break;
    }
    case 'morango': {
      fillingInput.value.placeholder = 'recheio - R$7'
      break;
    }
    case 'ninho': {
      fillingInput.value.placeholder = 'recheio - R$15'
      break;
    }
    case 'nutella': {
      fillingInput.value.placeholder = 'recheio - R$10'
      break;
    }
    case 'prestigio': {
      coverageInput.value.placeholder = 'cobertura - R$7'
      break;
    }
    case 'brigadeiro': {
      coverageInput.value.placeholder = 'cobertura - R$5'
      break;
    }
    default: break;
  }
  let total = `${massaInput.value.placeholder} ${fillingInput.value.placeholder} ${coverageInput.value.placeholder}`
  total = total.replace(/[^0-9|-]/g, '').split('-')
  let result = 0

  for (let i = 0; i < total.length; i++) {
    if(!total[i]) continue
    let value = +total[i]

    if(value) {
      result += value
    }
  }
  totalInput.value.placeholder = `TOTAL - ${result}` 
}
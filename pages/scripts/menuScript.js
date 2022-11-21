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
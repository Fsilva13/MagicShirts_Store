<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <table class="table table-bordered">
    <thead>
      <tr>
        <td><b>data</b></td>
        <td><b>preco total</b></td>
        <td><b>tipo pagamento</b></td>     
      </tr>
      </thead>
      <tbody>
      <tr>
        <td>
          {{$encomenda->data}}
        </td>
        <td>
          {{$encomenda->preco_total}}
        </td>
        <td>
          {{$encomenda->tipo_pagamento}}
        </td>
      </tr>
      </tbody>
    </table>
  </body>
</html>
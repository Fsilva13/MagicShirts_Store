<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />

  <link href="{{ asset('css/pdf.css') }}" rel="stylesheet">

</head>

<body>
  <div class="invoice-box">
    <table cellpadding="0" cellspacing="0">
      <tr class="top">
        <td colspan="2">
          <table>
            <tr>
              <td class="title">
                <img src="https://getlogovector.com/wp-content/uploads/2020/12/malaysian-global-innovation-and-creativity-centre-magic-logo-vector.png" style="width: 100%; max-width: 300px" />
              </td>

              <td>
                Fatura #: {{$encomenda->id}}<br />
                {{$encomenda->data}}<br />
              </td>
            </tr>
          </table>
        </td>
      </tr>

      <tr class="information">
        <td colspan="2">
          <table>
            <tr>
              <td>
                MagicShirts, Inc.<br />
                12345 Sunny Road<br />
                Sunnyville, CA 12345
              </td>

              <td>
                {{$encomenda->cliente->user->name}}<br />
                {{$encomenda->cliente->user->email}}
              </td>
            </tr>
          </table>
        </td>
      </tr>

      <tr class="heading">
        <td>Payment Method</td>

        <td>##</td>
      </tr>

      <tr class="details">
        <td>{{$encomenda->tipo_pagamento}}</td>

        <td>{{$encomenda->preco_total}} €</td>
      </tr>

      <tr class="heading">
        <td>Item</td>

        <td>Price</td>
      </tr>
      @foreach($encomenda->tshirts as $tshirt)
      <tr class="item">
        <td>Tshirt: {{$tshirt->estampa->nome}}</td>

        <td>{{$tshirt->preco_un}} €</td>
      </tr>
      @endforeach


      <tr class="total">
        <td></td>
        <td>Total: {{$encomenda->preco_total}} €</td>
      </tr>
    </table>
  </div>
</body>

</html>
<div class="row">
  <div class="col-md-4">
    <table class="table table-bordered table-striped">

      <tr>
        <td>ლექცია საკ.</td>
        <td>
          <?php if ($dist->leqcia_sak > 0): ?>
            <input type="checkbox" checked disabled class="form-control">
          <?php else: ?>
            <input type="checkbox" disabled class="form-control">
          <?php endif ?>
        </td>
      </tr>
      <tr>
        <td>პრაქტიკული საკ.</td>
        <td>
          <?php if ($dist->praqtikuli_sak > 0): ?>
            <input type="checkbox" checked disabled class="form-control">
          <?php else: ?>
            <input type="checkbox" disabled class="form-control">
          <?php endif ?>
        </td>
      </tr>

      <tr>
        <td>ლექცია დამ.</td>
        <td>
          <?php if ($dist->leqcia_dam > 0): ?>
            <input type="checkbox" checked disabled class="form-control">
          <?php else: ?>
            <input type="checkbox" disabled class="form-control">
          <?php endif ?>
        </td>
      </tr>

      <tr>
        <td>ლაბორატორიული საკ.</td>
        <td>
          <?php if ($dist->laboratoriuli_sak > 0): ?>
            <input type="checkbox" checked disabled class="form-control">
          <?php else: ?>
            <input type="checkbox" disabled class="form-control">
          <?php endif ?>
        </td>
      </tr>

      <tr>
        <td>პრაქტიკული დამ.</td>
        <td>
          <?php if ($dist->praqtikuli_dam > 0): ?>
            <input type="checkbox" checked disabled class="form-control">
          <?php else: ?>
            <input type="checkbox" disabled class="form-control">
          <?php endif ?>
        </td>
      </tr>

      <tr>
        <td>ლაბორატორიული დამ.</td>
        <td>
          <?php if ($dist->laboratoriuli_dam > 0): ?>
            <input type="checkbox" checked disabled class="form-control">
          <?php else: ?>
            <input type="checkbox" disabled class="form-control">
          <?php endif ?>
        </td>
      </tr>

      <tr>
        <td>შუალედური</td>
        <td>
          <?php if ($dist->shualeduri > 0): ?>
            <input type="checkbox" checked disabled class="form-control">
          <?php else: ?>
            <input type="checkbox" disabled class="form-control">
          <?php endif ?>
        </td>
      </tr>

      <tr>
        <td>დასკვნითი</td>
        <td>
          <?php if ($dist->daskvniti > 0): ?>
            <input type="checkbox" checked disabled class="form-control">
          <?php else: ?>
            <input type="checkbox" disabled class="form-control">
          <?php endif ?>
        </td>
      </tr>

    </table>
  </div>
</div>


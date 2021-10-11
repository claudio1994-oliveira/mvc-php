<?php include __DIR__ . '/../inicio-html.php'; ?>

    <form action="/salvar-curso<?= isset($curso) ? '?id=' . $curso->getId() : ''; ?>" METHOD="post" >
        <div class="imput-group">
            <label for="descricao">Descricao</label>
            <input type="text" id="descricao" name="descricao"
                   class="form-control"
            value="<?= isset($curso) ? $curso->getDescricao() : ''?>">
            <button class="btn btn-primary mt-3">Salvar</button>

        </div>
    </form>
<?php include __DIR__ . '/../fim-html.php'; ?>

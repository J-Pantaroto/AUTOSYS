<?php 
namespace App\Controllers;
use App\Models\Venda;
use App\Models\ItensVenda;


class VendaController
{
    public function create($data)
    {
        $venda = new Venda();
        $venda->cliente_id = $data['cliente_id'];
        $venda->data_venda = date('Y-m-d H:i:s');
        $venda->total = $data['total'];
        $venda->status = $data['status'];

        if ($venda->create()) {
            $venda_id = $venda->id; 

            foreach ($data['itens'] as $itemData) {
                $itemVenda = new ItensVenda();
                $itemVenda->venda_id = $venda_id;
                $itemVenda->produto_id = $itemData['produto_id'];
                $itemVenda->quantidade = $itemData['quantidade'];
                $itemVenda->preco_unitario = $itemData['preco_unitario'];
                $itemVenda->subtotal = $itemData['quantidade'] * $itemData['preco_unitario'];

                $itemVenda->create();
            }
            return true;
        }
        return false;
    }

    public function read()
    {
        $venda = new Venda();
        return $venda->read();
    }

    public function readOne($id)
    {
        $venda = new Venda();
        $venda->id = $id;
        $vendaData = $venda->readOne();

        // Busca os itens de venda associados a essa venda
        $itemVenda = new ItensVenda();
        $vendaData['itens'] = $itemVenda->getItensByVendaId($id);

        return $vendaData;
    }

    public function update($id, $data)
    {
        $venda = new Venda();
        $venda->id = $id;
        $venda->cliente_id = $data['cliente_id'];
        $venda->data_venda = $data['data_venda'];
        $venda->total = $data['total'];
        $venda->status = $data['status'];

        if ($venda->update()) {
            $itemVenda = new ItensVenda();
            $itemVenda->deleteByVendaId($id);

            foreach ($data['itens'] as $itemData) {
                $newItemVenda = new ItensVenda();
                $newItemVenda->venda_id = $id;
                $newItemVenda->produto_id = $itemData['produto_id'];
                $newItemVenda->quantidade = $itemData['quantidade'];
                $newItemVenda->preco_unitario = $itemData['preco_unitario'];
                $newItemVenda->subtotal = $itemData['quantidade'] * $itemData['preco_unitario'];

                $newItemVenda->create();
            }
            return true;
        }
        return false;
    }

    public function delete($id)
    {
        $itemVenda = new ItensVenda();
        $itemVenda->deleteByVendaId($id);

        $venda = new Venda();
        $venda->id = $id;
        return $venda->delete();
    }
}

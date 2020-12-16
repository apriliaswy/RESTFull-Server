<?php


class Petugas_model extends CI_model
{
	public function getPetugas($id = null)
	{
		if ($id == null) 
		{
			return $this->db->get('petugas')->result_array();
		}
		else
		{
			return $this->db->get_where('petugas', ['id' => $id])->result_array();
		}
	}
	public function deletePetugas($id)
	{
		$this->db->delete('petugas', ['id' => $id]);
		return $this->db->affected_rows();
	}
	public function createPetugas($data)
	{
		$this->db->insert('petugas', $data);
		return $this->db->affected_rows();
	}
	public function updatePetugas($data, $id)
	{
		$this->db->update('petugas', $data, ['id' => $id]);
		return $this->db->affected_rows();
	}
}
<?php

namespace App\Http\Controllers\FrontEnd;

use App\DanhGiaSao;
use App\Http\Controllers\Controller;
use App\SanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SanPhamController extends Controller
{
    public function __constructor()
    {

    }

    public function ChiTietSp($id)
    {
        $chitiet = SanPham::find($id);
        $tieude = $chitiet->tensanpham;
        $masanpham = isset($chitiet->maquatang) ? $chitiet->j_quatang->masanpham : '';

        if (isset($chitiet->maquatang)) {
            $ma = explode(',', $chitiet->j_quatang->masanpham);
            foreach ($ma as $m) {

                $quatang[] = SanPham::find($m);
            }
        } else {
            $quatang = null;
        }
        $sanphamtuongtu = SanPham::where('mahang', $chitiet->mahang)->get();

        // Danh Gia Sao
        $danGiaSao = DanhGiaSao::groupBy('sosao')
            ->where('masanpham', $id)
            ->select(DB::raw('count(sosao) as soDanhGia'), DB::raw('sum(sosao) as tongDanhGia'))
            ->addSelect('sosao')
            ->get()->toArray();

        $arrDanhGia = [];
        if (!empty($danGiaSao)) {
            for ($i = 1; $i <= 5; $i++) {
                $arrDanhGia[$i] = [
                    "soDanhGia" => 0,
                    "tongDanhGia" => 0,
                    "sosao" => 0,
                ];
                foreach ($danGiaSao as $danhgia) {
                    if ($danhgia['sosao'] == $i) {
                        $arrDanhGia[$i] = $danhgia;
                        continue;
                    }
                }
            }
        } else {
            for ($i = 1; $i <= 5; $i++) {
                $arrDanhGia[$i] = [
                    "soDanhGia" => 0,
                    "tongDanhGia" => 0,
                    "sosao" => 0,
                ];
            }
        }

        // dd($arrDanhGia);
        return view('User.chitietsanpham', compact('chitiet', 'tieude', 'quatang', 'sanphamtuongtu', 'arrDanhGia'));
    }

    public function DanhSachSp($id, Request $request)
    {
        $tieude = in_array($id, ['laptop', 'phukien']) ? 'Danh sách sản phẩm' : 'Tìm Kiếm';
        if (isset($_GET['loc'])) {
            $hangsx = isset($_GET['hangsx']) ? $_GET['hangsx'] : '';
            $cpu = isset($_GET['cpu']) ? $_GET['cpu'] : '';
            $ram = isset($_GET['ram']) ? $_GET['ram'] : '';
            $carddohoa = isset($_GET['carddohoa']) ? $_GET['carddohoa'] : '';
            $ocung = isset($_GET['ocung']) ? $_GET['ocung'] : '';
            $manhinh = isset($_GET['manhinh']) ? $_GET['manhinh'] : '';
            $tinhtrang = isset($_GET['tinhtrang']) ? $_GET['tinhtrang'] : '';
            $mucgia = isset($_GET['mucgia']) ? $_GET['mucgia'] : '';
            $sapxep = isset($_GET['sapxep']) ? $_GET['sapxep'] : '';
            $nhucau = isset($_GET['nhucau']) ? $_GET['nhucau'] : '';

            $sql = "SELECT * FROM sanpham s, laptop l, thuvienhinh tv WHERE s.malaptop = l.malaptop AND s.mathuvienhinh = tv.mathuvienhinh AND loaisanpham = 0 ";
            if ($hangsx != '') {
                $sql .= " AND s.mahang IN(" . $hangsx . ")";
            }
            if ($cpu != '') {
                $cpu_arr = array();
                foreach (explode(',', $cpu) as $val) {
                    $cpu_arr[] = $val;
                }
                $chuoi = implode('|', $cpu_arr);
                $sql .= " AND cpu REGEXP '" . $chuoi . "'";
            }
            if ($ram != '') {
                $sql .= " AND ram IN(" . $ram . ")";
            }
            if ($carddohoa != '') {
                $sql .= " AND carddohoa IN(" . $carddohoa . ")";
            }
            if ($ocung != '') {
                $sql .= " AND ocung IN('" . $ocung . "')";
            }
            if ($manhinh != '') {
                $mh = explode(',', $manhinh);
                $setMaxManHinh = 24;
                if (count($mh) == 1) {
                    if ($mh[0] == 15) {
                        $sql .= " AND manhinh > 15";
                    } elseif ($mh[0] == 14) {
                        $sql .= " AND manhinh < 15";
                    } else {
                        $sql .= " AND manhinh < 14";
                    }
                } elseif (count($mh) == 2) {
                    if ($mh[0] == 15 && $mh[1] == 14) {
                        $sql .= " AND manhinh BETWEEN 14 AND $setMaxManHinh ";
                    } elseif ($mh[0] == 15 && $mh[1] == 13) {
                        $sql .= " AND BETWEEN 12 AND $setMaxManHinh ";

                    } elseif ($mh[0] == 14 && $mh[1] == 13) {
                        $sql .= " AND BETWEEN 12 AND 14 ";
                    }
                } else {
                    $sql .= " AND manhinh BETWEEN 12 AND $setMaxManHinh ";
                }
            }
            if ($tinhtrang != '') {
                $sql .= " AND tinhtrang IN(" . $tinhtrang . ")";
            }
            if ($mucgia != '') {
                $mg = explode(',', $mucgia);
                $setGiaCao = 999999999;
                $setGiaThap = 4000000;
                if (count($mg) == 1) {
                    if ($mg[0] == 'tren-25') {
                        $sql .= " AND giaban > 25000000";
                    } elseif ($mg[0] == 'tu-20-25') {
                        $sql .= " AND giaban BETWEEN 20000000 AND 25000000";
                    } elseif ($mg[0] == 'tu-15-20') {
                        $sql .= " AND giaban BETWEEN 15000000 AND 20000000";
                    } elseif ($mg[0] == 'tu-10-15') {
                        $sql .= " AND giaban BETWEEN 10000000 AND 15000000";
                    } else {
                        $sql .= " AND giaban BETWEEN 3000000 AND 10000000";
                    }
                } elseif (count($mg) == 2) {
                    if ($mg[0] == 'tren-25') {
                        $sql .= " AND giaban > 25000000";
                    } elseif ($mg[0] == 'tu-20-25') {
                        $sql .= " AND giaban BETWEEN 20000000 AND 25000000";
                    } elseif ($mg[0] == 'tu-15-20') {
                        $sql .= " AND giaban BETWEEN 15000000 AND 20000000";
                    } elseif ($mg[0] == 'tu-10-15') {
                        $sql .= " AND giaban BETWEEN 10000000 AND 15000000";
                    } else {
                        $sql .= " AND giaban BETWEEN 3000000 AND 10000000";
                    }
                    if ($mg[1] == 'tren-25') {
                        $sql .= " OR giaban > 25000000";
                    } elseif ($mg[1] == 'tu-20-25') {
                        $sql .= " OR giaban BETWEEN 20000000 AND 25000000";
                    } elseif ($mg[1] == 'tu-15-20') {
                        $sql .= " OR giaban BETWEEN 15000000 AND 20000000";
                    } elseif ($mg[1] == 'tu-10-15') {
                        $sql .= " OR giaban BETWEEN 10000000 AND 15000000";
                    } else {
                        $sql .= " OR giaban BETWEEN 3000000 AND 10000000";
                    }
                } elseif (count($mg) == 3) {
                    if ($mg[0] == 'tren-25' && $mg[2] == 'tu-20-25') {
                        $sql .= " AND giaban BETWEEN 20000000 AND $setGiaCao";
                    } elseif ($mg[0] == 'tren-25' && $mg[2] == 'tu-15-20') {
                        $sql .= " AND giaban BETWEEN 15000000 AND $setGiaCao";
                    } elseif ($mg[0] == 'tren-25' && $mg[2] == 'tu-10-15') {
                        $sql .= " AND giaban BETWEEN 10000000 AND $setGiaCao";
                    } elseif ($mg[0] == 'tren-25' && $mg[2] == 'duoi-10') {
                        $sql .= " AND giaban BETWEEN $setGiaThap AND $setGiaCao";

                    } elseif ($mg[0] == 'tu-20-25' && $mg[2] == 'tu-15-20') {
                        $sql .= " AND giaban BETWEEN 15000000 AND 25000000";
                    } elseif ($mg[0] == 'tu-20-25' && $mg[2] == 'tu-10-15') {
                        $sql .= " AND giaban BETWEEN 10000000 AND 25000000";
                    } elseif ($mg[0] == 'tu-20-25' && $mg[2] == 'duoi-10') {
                        $sql .= " AND giaban BETWEEN 4000000 AND 25000000";

                    } elseif ($mg[0] == 'tu-15-20' && $mg[2] == 'tu-10-15') {
                        $sql .= " AND giaban BETWEEN 10000000 AND 20000000";
                    } elseif ($mg[0] == 'tu-15-20' && $mg[2] == 'duoi-10') {
                        $sql .= " AND giaban BETWEEN $setGiaThap AND 20000000";

                    } elseif ($mg[0] == 'tu-10-15' && $mg[2] == 'duoi-10') {
                        $sql .= " AND giaban BETWEEN $setGiaThap AND 15000000";
                    }
                } elseif (count($mg) == 4) {
                    if ($mg[0] == 'tren-25' && $mg[3] == 'tu-20-25') {
                        $sql .= " AND giaban BETWEEN 20000000 AND $setGiaCao";
                    } elseif ($mg[0] == 'tren-25' && $mg[3] == 'tu-15-20') {
                        $sql .= " AND giaban BETWEEN 15000000 AND $setGiaCao";
                    } elseif ($mg[0] == 'tren-25' && $mg[3] == 'tu-10-15') {
                        $sql .= " AND giaban BETWEEN 10000000 AND $setGiaCao";
                    } elseif ($mg[0] == 'tren-25' && $mg[3] == 'duoi-10') {
                        $sql .= " AND giaban BETWEEN $setGiaThap AND $setGiaCao";

                    } elseif ($mg[0] == 'tu-20-25' && $mg[3] == 'tu-15-20') {
                        $sql .= " AND giaban BETWEEN 15000000 AND 25000000";
                    } elseif ($mg[0] == 'tu-20-25' && $mg[2] == 'tu-10-15') {
                        $sql .= " AND giaban BETWEEN 10000000 AND 25000000";
                    } elseif ($mg[0] == 'tu-20-25' && $mg[3] == 'duoi-10') {
                        $sql .= " AND giaban BETWEEN 4000000 AND 25000000";

                    } elseif ($mg[0] == 'tu-15-20' && $mg[3] == 'tu-10-15') {
                        $sql .= " AND giaban BETWEEN 10000000 AND 20000000";
                    } elseif ($mg[0] == 'tu-15-20' && $mg[3] == 'duoi-10') {
                        $sql .= " AND giaban BETWEEN $setGiaThap AND 20000000";

                    } elseif ($mg[0] == 'tu-10-15' && $mg[3] == 'duoi-10') {
                        $sql .= " AND giaban BETWEEN $setGiaThap AND 15000000";
                    }
                } else {
                    $sql .= " AND giaban BETWEEN $setGiaThap AND $setGiaCao";
                }
            }
            if ($sapxep != '') {
                if ($sapxep == 'moinhat') {
                    $sql .= " ORDER BY masanpham desc";
                } elseif ($sapxep == 'banchay') {

                } elseif ($sapxep == 'uudai') {
                    $sql .= " AND giakhuyenmai > 0";
                } elseif ($sapxep == 'giatang') {
                    $sql .= " ORDER BY giaban asc";
                } elseif ($sapxep == 'giagiam') {
                    $sql .= " ORDER BY giaban desc";
                }
            }
            if ($nhucau != '') {
                $sql .= " AND nhucau LIKE '%" . $nhucau . "%'";
            }

            $sanpham = DB::select($sql);

        } elseif (isset($_GET['sap-xep'])) {
            $sapxep = $_GET['sap-xep'];
            $loai = $_GET['loai'];
            $sql = "SELECT * FROM sanpham s LEFT JOIN  laptop l ON l.malaptop = s.malaptop INNER JOIN thuvienhinh tv ON tv.mathuvienhinh=s.mathuvienhinh ";
            if ($loai == 0) {
                $sql .= "WHERE loaisanpham = 0 ";

            } else {

                $sql .= "WHERE loaisanpham = 1 ";
            }

            if ($sapxep == 'moinhat') {
                $sql .= "ORDER BY masanpham desc ";
            } elseif ($sapxep == 'banchay') {

            } elseif ($sapxep == 'uudai') {
                $sql .= "AND giakhuyenmai > 0 ";
            } elseif ($sapxep == 'giatang') {
                $sql .= "ORDER BY giaban ASC ";
            } elseif ($sapxep == 'giagiam') {
                $sql .= "ORDER BY giaban DESC ";
            }
            $sanpham = DB::select($sql);
        } else {

            if ($id == 'laptop') {
                $sanpham = SanPham::where('loaisanpham', 0)
                    ->join('laptop as l', 'l.malaptop', 'sanpham.malaptop')
                    ->join('thuvienhinh as tv', 'tv.mathuvienhinh', 'sanpham.mathuvienhinh')
                    ->get();
                // $cpu = LapTop::select('cpu')->distinct()->get();
            } else {
                $sanpham = SanPham::where('loaisanpham', 1)
                    ->join('thuvienhinh as tv', 'tv.mathuvienhinh', 'sanpham.mathuvienhinh')
                    ->get();
            }
        }

        return view('User.danhsachsp', compact('tieude', 'sanpham', 'id'));
    }

    public function TimKiem()
    {
        $tukhoa = $_GET['tukhoa'];
        $loai = $_GET['loaiTimKiem'];
        $tieude = 'Tìm Kiếm' . ' " ' . $tukhoa . ' "';

        $sql = "SELECT * FROM sanpham s LEFT JOIN  laptop l ON l.malaptop = s.malaptop INNER JOIN thuvienhinh tv ON tv.mathuvienhinh=s.mathuvienhinh ";

        if ($tukhoa != '') {
            if ($loai == 'tatca') {
                $sql .= "AND s.tensanpham LIKE '%$tukhoa%' ";
            } elseif ($loai == 'laptop') {
                $sql .= "AND s.tensanpham LIKE '%$tukhoa%' AND loaisanpahm = 0 ";
            } elseif ($loai == 'phukien') {
                $sql .= "AND s.tensanpham LIKE '%$tukhoa%' AND loaisanpahm = 1 ";
            } else {
                $sql .= "AND s.tensanpham LIKE '%$tukhoa%' AND mahang = {$loai} ";
            }
        } else {
            if ($loai == 'tatca') {
                $sql .= "";
            } elseif ($loai == 'laptop') {
                $sql .= "AND loaisanpham = 0 ";
            } elseif ($loai == 'phukien') {
                $sql .= "AND loaisanpham = 1 ";
            } else {
                $sql .= "AND mahang = {$loai} ";
            }
        }
        if (isset($_GET['sap-xep'])) {
            $sapxep = $_GET['sap-xep'];

            if ($sapxep == 'moinhat') {
                $sql .= "ORDER BY masanpham desc ";
            } elseif ($sapxep == 'banchay') {

            } elseif ($sapxep == 'uudai') {
                $sql .= "AND giakhuyenmai > 0 ";
            } elseif ($sapxep == 'giatang') {
                $sql .= "ORDER BY giaban asc ";
            } elseif ($sapxep == 'giagiam') {
                $sql .= "ORDER BY giaban desc ";
            }
        }

        $sanpham = DB::select($sql);

        // dd($sanpham);

        $id = $loai == 'laptop' ? 'laptops' : $loai;

        return view('User.danhsachsp', compact('tieude', 'sanpham', 'id'));
    }

    public function DanhGiaSao(Request $request)
    {
        if (session()->has('dangnhap')) {
            $manguoidung = session()->get('dangnhap')['manguoidung'];
            $sao = DanhGiaSao::where([['manguoidung', $manguoidung], ['masanpham', $request->masanpham]])->first();
            if ($sao) {
                $sao->sosao = $request->numberStar;
                $sao->save();
            } else {
                $sao = new DanhGiaSao();
                $sao->masanpham = $request->masanpham;
                $sao->manguoidung = $manguoidung;
                $sao->sosao = $request->numberStar;
                $sao->save();
            }

            return redirect()->back()->with('alert', 'Thành Công');
        } else {
            return redirect()->back()->with('alert', 'Vui lòng đăng nhập để tíếp tục đánh giá sản phẩm!');
        }
    }
}
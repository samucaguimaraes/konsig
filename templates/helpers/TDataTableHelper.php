<?php

/**
 * Description of AjaxHelper
 * @author igor
 */
class TDataTableHelper {

    public static function mountOrderBy(array & $atributos, $position, $orderby) {

        $order = null;
        if (isset($atributos[$position])) {
            $order = $atributos[$position] . ':' . $orderby;
        }

        return $order;
    }

    public static function mountOrderByQuery(array & $colunas, $position, $orderby) {

        $order = null;
        if (isset($colunas[$position])) {
            $order = $colunas[$position] . ' ' . $orderby;
        }

        return $order;
    }

    /**
     * 
     * @param array $colunas
     * @param type $search
     * @param type $and 
     * passar false quando não tiver 'AND' no inicio da query
     * @return type
     * 
     */
    public static function mountSearch(array & $colunas, $search, $and = true) {
        if ($search !== '') {
            $search = $search;

            function getInit($key, $value, &$search) {
                if (is_array($value)) {
                    $arrayQuery = array();
                    $pesquisa = strtolower($search);
                    $flagInit = true;
                    foreach ($value as $k => $val) {
                        $localizar = strpos(strtolower($val), $pesquisa);
                        if ($localizar !== false) {
                            if ($flagInit) {
                                $arrayQuery[] = "{$key} like '%{$k}%'";
                                $flagInit = false;
                            } else {
                                $arrayQuery[] = "OR {$key} like '%{$k}%'";
                            }
                        }
                        unset($localizar);
                    }
                    $query = (isset($arrayQuery[0])) ? implode(' ', $arrayQuery) : '';
                    unset($arrayQuery);
                    unset($flagInit);
                    unset($pesquisa);
                    return $query;
                } else {
                    return "{$value} like '%{$search}%'";
                }
            }

            function getOr($key, $value, &$search) {
                if (is_array($value)) {
                    $arrayQuery = array();
                    $pesquisa = strtolower($search);
                    foreach ($value as $k => $val) {
                        $localizar = strpos(strtolower($val), $pesquisa);
                        if ($localizar !== false) {
                            $arrayQuery[] = "OR {$key} like '%{$k}%'";
                        }
                        unset($localizar);
                    }
                    $query = (isset($arrayQuery[0])) ? implode(' ', $arrayQuery) : '';
                    unset($arrayQuery);
                    unset($pesquisa);
                    return $query;
                } else {
                    return "OR {$value} like '%{$search}%'";
                }
            }

            $flag = true;
            $arraySearch = array();
            $arraySearch[] = ($and === true) ? 'AND (' : '(';
            foreach ($colunas as $key => $value) {
                if ($flag) {
                    $flag = false;
                    $arraySearch[] = getInit($key, $value, $search);
                } else {
                    $or = getOr($key, $value, $search);
                    ($or !== '') ? $arraySearch[] = $or : '';
                    unset($or);
                }
            }
            $arraySearch[] = ")";
            $querySearch = implode(' ', $arraySearch);
            return $querySearch;
        } else {
            return ($and === true) ? '' : null;
        }
    }

    public static function mountArrayOutPut($sEcho, $iTotal) {

        $output = array(
            "sEcho" => intval($sEcho),
            "iTotalRecords" => $iTotal,
            "iTotalDisplayRecords" => $iTotal,
            "aaData" => array()
        );

        return $output;
    }

}
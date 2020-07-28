<?php

namespace App\Input\Admin;
use Illuminate\Support\Facades\DB;

class Configurations {

    public static function getGlobalConfiguration()
    {
//        $file = file_get_contents(env('BASE_DIR').'/include/global/settings.php');
//        preg_match_all('/\s*\/?\/?([a-z0-9_\-,\.\s\(\)\"\']+)?\s*define\(\s*\'([a-z0-9_]+)\'\s*,\s*([\'\"])?([a-z0-9_]+)([\'\"])?\s*\)\;/i', $file, $matches);
//        $res = [];
//        if (empty($matches[2]))
//            return $res;
//        foreach ($matches[2] as $key => $value)
//        {
//            if ($matches[3][$key] && $matches[5][$key])
//                $res[$value] = [
//                    'value'     =>$matches[4][$key],
//                ];
//            else
//                $res[$value] = [
//                    'value'     =>(int)$matches[4][$key],
//                ];
//            $res[$value]['comment'] = trim($matches[1][$key]);
//        }
        //return $res;
        return [];
    }

    public static function saveGlobalConfiguration($fields)
    {
        $vars = self::getGlobalConfiguration();
        $content = "<?php\r\n";
        if (!is_array($fields) || empty($fields))
        {
            $file = file_put_contents(env('BASE_DIR').'/include/global/settings.php',$content);
            return true;
        }
        foreach ($fields as $param_name => $param_value)
        {
            if (!isset($vars[$param_name]))
                continue;
            $content .= '//'.$vars[$param_name]['comment']."\r\n";
            $content .= 'define(\''.$param_name.'\', '.(!is_numeric($vars[$param_name]['value']) ? '\''.$param_value.'\'' : $param_value).");\r\n";
        }
        $file = file_put_contents(env('BASE_DIR').'/include/global/settings.php', $content);
    }
}

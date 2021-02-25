<?php
namespace AdminTest;

use Doctrine\ORM\EntityManager;
use function implode;
use function str_replace;

class TestDataSet
{
    /**
     * @var array
     */
    protected $tables = [];

    /**
     * @param array $data Expected data format is similar to CSV:
     * First level has table names as keys and are also arrays;
     * Second level has the first element as an array of columns;
     * Other elements are array of values.
     */
    public function __construct(array $data, EntityManager $em)
    {
        foreach ($data as $tableName => $rows) {
            $columns = [];
            if (isset($rows[0])) {
                $columns = array_shift($rows);
            }

            $valuesInsert = [];
            foreach ($rows as $index => $row) {
                $values = [];

                if (count($columns) != count($row)) {
                    throw new \Exception(sprintf(
                        '%s: Wrong number of values in row %d. Expected %d got %d!',
                        $tableName,
                        $index,
                        count($columns),
                        count($row)
                    ));
                }

                for ($i=0; $i<count($columns); $i++) {
                    $values[] = $row[$i] ?? null;
                }

                $valuesInsert[] = $values;
            }

            if (!count($valuesInsert)) {
                continue;
            }

            $insertColumns = implode(",", $columns);
            $insertValues = "";
            foreach ($valuesInsert as $key => $value) {
                $insertValues.= "('".implode("','", $value)."')";
                if (array_key_last($valuesInsert) != $key) {
                    $insertValues.= ",";
                }
            }
            $insertValues = str_replace("''", 'null', $insertValues);
            $em->getConnection()->exec("INSERT INTO {$tableName} ({$insertColumns}) VALUES {$insertValues}");
        }

    }
}

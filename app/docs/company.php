<?php
/**
 * @OA\Get(
 *  path="/api/v1/companies",
 *  summary="Lista de Empresas",
 *  operationId="Lista de Empresas Cadastradas",
 *  tags={"Empresa"},
 *  description="Lista de Empresas
 * O token deverá ser enviado na requisição",
 *  security={{"bearerAuth":{}}},
 *  @OA\Response(
 *     response=200,
 *     description="Successful operation",
 *     @OA\MediaType(
 *          mediaType="application/json",
 *          @OA\Schema(
 *              @OA\Property(
 *                  property="data",
 *                  type="array",
 *                  @OA\Items(
 *                     @OA\Property(property="id", type="integer", example="1"),
 *                     @OA\Property(property="name", type="string", example="Talentify"),
 *                  ),
 *              ),
 *              @OA\Property(
 *                  property="links",
 *                  type="array",
 *                  @OA\Items(
 *                      @OA\Property(property="first", type="integer"),
 *                      @OA\Property(property="last", type="integer"),
 *                      @OA\Property(property="prev", type="integer"),
 *                      @OA\Property(property="next", type="integer"),
 *                  )
 *              ),
 *              @OA\Property(
 *                  property="meta",
 *                  type="array",
 *                  @OA\Items(
 *                      @OA\Property(property="current_page", type="integer"),
 *                      @OA\Property(property="from", type="integer"),
 *                      @OA\Property(property="last_page", type="integer"),
 *                      @OA\Property(property="path", type="string"),
 *                      @OA\Property(property="per_page", type="integer"),
 *                      @OA\Property(property="to", type="integer"),
 *                      @OA\Property(property="total", type="integer"),
 *                  )
 *              ),
 *          )
 *     )
 *  ),
 *  @OA\Response(
 *     response=402,
 *     description="{'error': 'Token expired.}",
 *  ),
 * )
 */

/**
 * @OA\Get(
 *  path="/api/v1/companies/{id}",
 *  summary="Retorna os dados de uma Empresa",
 *  operationId="OneCompany",
 *  tags={"Empresa"},
 *  description="Retorna os dados de uma Empresa
 *  O token deverá ser enviado na requisição.",
 *  security={{"bearerAuth":{}}},
 *  @OA\Parameter(
 *      name="id",
 *      in="path",
 *      description="id da Empresa a ser vista",
 *      required=true,
 *      @OA\Schema(type="integer")
 *  ),
 *  @OA\Response(
 *     response=200,
 *     description="Successful operation",
 *     @OA\MediaType(
 *          mediaType="application/json",
 *          @OA\Schema(
 *              @OA\Property(
 *                  property="data",
 *                  type="array",
 *                  @OA\Items(
 *                     @OA\Property(property="id", type="integer", example="1"),
 *                     @OA\Property(property="name", type="string", example="Talentify"),
 *                  ),
 *              ),
 *          )
 *     )
 *  ),
 *  @OA\Response(
 *     response=401,
 *     description="{'error': 'Token expired.}",
 *  ),
 *  @OA\Response(
 *     response=404,
 *     description="{'error': 'Company Not Found.'}",
 *  ),
 *  @OA\Response(
 *     response=500,
 *     description="{'error': 'ID must be a number.'}",
 *  ),
 * )
 */

/**
 * @OA\Post(
 *  path="/api/v1/companies",
 *  summary="Cadastrar uma nova Empresa.",
 *  operationId="CadastrarEmpresa",
 *  tags={"Empresa"},
 *  description="Cadastrar uma nova Empresa.
 *  O token deverá ser enviado na requisição.
 *  Campos Obrigatóros: name.",
 *  security={{"bearerAuth":{}}},
 *  @OA\RequestBody(
 *      description="Data required",
 *      required=true,
 *      @OA\MediaType(
 *          mediaType="application/json",
 *          @OA\Schema(
 *              @OA\Property(property="name", type="string", example="Talentify"),
 *          )
 *      )
 *  ),
 *  @OA\Response(
 *     response=201,
 *     description="{'success': 'Company Created!'}",
 *  ),
 *  @OA\Response(
 *    response=422,
 *    description="error: O retorno será um array contendo a informação do(s) campo(s) obrigatório(s)",
 *    @OA\MediaType(
 *       mediaType="application/json",
 *       @OA\Schema(
 *         @OA\Property(
 *            property="error",
 *            type="array",
 *            @OA\Items(
 *               type="string",
 *               enum = {"O campo nome é obrigatório."},
 *            ),
 *         ),
 *         ),
 *       ),
 *     ),
 *   ),
 * )
 */

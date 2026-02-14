SELECT * FROM gabriel.veiculos ORDER BY modelo;

SELECT p.nome_completo, v.id, v.modelo, v.placa, v.marca FROM gabriel.veiculos v JOIN gabriel.proprietarios p ON p.id = v.proprietario_id ORDER BY p.nome_completo;

SELECT p.sexo, COUNT(v.id) as total_veiculos FROM gabriel.proprietarios p JOIN gabriel.veiculos v ON p.id = v.proprietario_id GROUP BY p.sexo ORDER BY total_veiculos DESC;

SELECT marca, COUNT(*) as total_veiculos FROM gabriel.veiculos GROUP BY marca ORDER BY total_veiculos DESC;

SELECT p.sexo, v.marca, COUNT(v.id) as total_veiculos FROM gabriel.veiculos v JOIN gabriel.proprietarios p ON p.id = v.proprietario_id GROUP BY v.marca, p.sexo ORDER BY total_veiculos DESC, v.marca, p.sexo;

SELECT nome_completo, sexo, data_nascimento, EXTRACT(YEAR FROM AGE(CURRENT_DATE, data_nascimento)) as idade FROM gabriel.proprietarios ORDER BY nome_completo;

SELECT sexo, COUNT(*) as total_proprietarios, ROUND(AVG(EXTRACT(YEAR FROM AGE(CURRENT_DATE, data_nascimento))), 2) as idade_media FROM gabriel.proprietarios GROUP BY sexo ORDER BY sexo DESC;

SELECT r.data_revisao, v.modelo, v.placa, v.marca FROM gabriel.revisoes r JOIN gabriel.veiculos v ON v.id = r.veiculo_id WHERE r.data_revisao BETWEEN '2023-03-01' AND '2024-06-01' ORDER BY r.data_revisao;

SELECT v.marca, COUNT(r.id) as total_revisoes FROM gabriel.veiculos v JOIN gabriel.revisoes r ON r.veiculo_id = v.id GROUP BY v.marca ORDER BY total_revisoes DESC, v.marca;

SELECT p.nome_completo, p.sexo, COUNT(r.id) as total_revisoes FROM gabriel.proprietarios p JOIN gabriel.veiculos v ON v.proprietario_id = p.id JOIN gabriel.revisoes r ON r.veiculo_id = v.id GROUP BY p.nome_completo, p.sexo ORDER BY total_revisoes DESC;

WITH revisoes_ordenadas AS (SELECT p.id as proprietario_id, p.nome_completo, r.data_revisao, LAG(r.data_revisao) OVER (PARTITION BY p.id ORDER BY r.data_revisao) as revisao_anterior FROM gabriel.proprietarios p JOIN gabriel.veiculos v ON v.proprietario_id = p.id JOIN gabriel.revisoes r ON r.veiculo_id = v.id) SELECT proprietario_id, nome_completo, COUNT(*) as total_intervalos, ROUND(AVG(data_revisao - revisao_anterior), 2) as media_dias_entre_revisoes FROM revisoes_ordenadas WHERE revisao_anterior IS NOT NULL GROUP BY proprietario_id, nome_completo ORDER BY media_dias_entre_revisoes, nome_completo;

WITH ultima_revisao AS (SELECT p.id as proprietario_id, p.nome_completo, v.id as veiculo_id, v.modelo, v.placa, MAX(r.data_revisao) as ultima_data FROM gabriel.proprietarios p JOIN gabriel.veiculos v ON v.proprietario_id = p.id JOIN gabriel.revisoes r ON r.veiculo_id = v.id GROUP BY p.id, p.nome_completo, v.id, v.modelo, v.placa), intervalos AS (SELECT p.id AS proprietario_id, r.data_revisao - LAG(r.data_revisao) OVER (PARTITION BY p.id ORDER BY r.data_revisao) AS dias_entre FROM gabriel.proprietarios p JOIN gabriel.veiculos v ON v.proprietario_id = p.id JOIN gabriel.revisoes r ON r.veiculo_id = v.id),media_pessoa AS (SELECT proprietario_id, ROUND(AVG(dias_entre)) AS media_dias FROM intervalos WHERE dias_entre IS NOT NULL GROUP BY proprietario_id) SELECT ur.proprietario_id, ur.nome_completo, ur.veiculo_id, ur.modelo, ur.placa, ur.ultima_data as ultima_revisao,COALESCE(mp.media_dias, 180) as media_dias_entre_revisoes,(ur.ultima_data + INTERVAL '1 day' * COALESCE(mp.media_dias, 180))::date as proxima_revisao_estimada, CASE WHEN (ur.ultima_data + INTERVAL '1 day' * COALESCE(mp.media_dias, 180))::date < CURRENT_DATE THEN 'ATRASADA' WHEN (ur.ultima_data + INTERVAL '1 day' * COALESCE(mp.media_dias, 180))::date <= CURRENT_DATE + 30 THEN 'PRÓXIMA' ELSE 'EM DIA' END as status FROM ultima_revisao ur LEFT JOIN media_pessoa mp ON ur.proprietario_id = mp.proprietario_id ORDER BY proxima_revisao_estimada;